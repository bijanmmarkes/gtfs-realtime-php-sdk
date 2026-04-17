# GTFS Realtime PHP SDK

---
This SDK is primarily using auto-generated files from the official `protoc` compiler's native PHP output. There are some modifications put in place
which allow it to work with GTFS Realtime. An example of that would be the porting of the `gtfs-realtime.proto` file to `proto3`
so that the protoc command actually works. There are also changes that allow us to use ENUM defaults that are `0` which aren't friendly with the proto standard. ex: `Incrementality FULL_DATASET` is overwritten
and defaulted to `DIFFERENTIAL` which is a big issue when creating feeds as it is currently
an experimental field and typically not used at all.

## Spec coverage

The bundled `gtfs-realtime.proto` is kept in sync with the upstream
[GTFS-Realtime reference proto](https://github.com/google/transit/blob/master/gtfs-realtime/proto/gtfs-realtime.proto),
including recent/experimental additions:

- `FeedHeader.feed_version`
- `FeedEntity.shape`, `.stop`, `.trip_modifications`
- `TripUpdate.StopTimeEvent.scheduled_time`
- `TripUpdate.StopTimeUpdate.departure_occupancy_status`, `.stop_time_properties`, `ScheduleRelationship.UNSCHEDULED`
- `TripUpdate.TripProperties` (trip_id, start_date/time, shape_id, headsign, short_name)
- `VehiclePosition.multi_carriage_details` with the `CarriageDetails` sub-message
- `Alert.cause_detail`, `Alert.effect_detail`
- `TripDescriptor.ScheduleRelationship` extras: `REPLACEMENT`, `DUPLICATED`, `DELETED`, `NEW`
- `TripDescriptor.ModifiedTripSelector`
- `VehicleDescriptor.wheelchair_accessible` with the `WheelchairAccessible` enum
- `EntitySelector.direction_id`
- Top-level `Stop` (with `WheelchairBoarding` enum), `TripModifications`, `StopSelector`, `ReplacementStop`

### Custom additions (not in upstream)

- `Alert.Cause.SPECIAL_EVENT = 13` — reserved for feeds that need to signal a planned special event as a cause.

## Examples

Create an empty FeedMessage with a valid FeedHeader attached, typically when there is no data to display,
this is what Google expects to see from an empty feed with no data. Empty feeds are more common with Alerts
as if there are no active alerts, there should simply be a non-stale feed header with the timestamp being updated
every 30 seconds or so.

```php
# Create a feed header
$feedHeader = new FeedHeader(
        [
            'gtfs_realtime_version' => '2.0',
            'incrementality' => Incrementality::FULL_DATASET,
            'timestamp' => time()
        ]
);

# Create a new FeedMessage
$feedMessage = new FeedMessage();

# Attach the header to the feed message
$feedMessage->setHeader($feedHeader);

# Serialize it to a string
$body = $feedMessage->serializeToString();

$file = fopen('empty-feed.pb', 'wb');

fwrite($file, $body);
```

Keep in mind all we did was create an empty FeedMessage with the bare-minimums to pass validation, which is a valid FeedHeader
and empty body, which in practice would be an Alert, TripUpdate, or VehiclePosition within a FeedEntity object.

## Running tests

```
composer install
composer test
```

PHPUnit covers the round-trip behavior of every message the SDK exposes,
including the new spec additions, the custom `SPECIAL_EVENT` cause, and a
regression test pinning the `Message.php` enum patch (see Developer Notes).

## Building it yourself

---
#### Regenerating PHP classes

Requires [protoc](https://github.com/protocolbuffers/protobuf/releases) on the `PATH`
(tested with `protoc 33.4`). The official PHP generator is built in.

```
protoc --proto_path=. --php_out=src/GtfsRealtime protobuf/gtfs-realtime.proto
```

This writes to:

- `src/GtfsRealtime/Google/Transit/Realtime/` — message and enum classes
- `src/GtfsRealtime/GPBMetadata/Protobuf/GtfsRealtime.php` — descriptor metadata

After regenerating, re-run the test suite (`composer test`) to confirm the
`Message.php` enum patch is still in place — the regression test in
`tests/Proto3EnumPatchRegressionTest.php` will fail if it was clobbered.

#### Notes and gotchas

- **`NEW` is renamed to `PBNEW`**: `TripDescriptor.ScheduleRelationship.NEW` is a PHP reserved word. `protoc --php_out` automatically renames the generated constant to `PBNEW` (value stays `8`). Use `TripDescriptor\ScheduleRelationship::PBNEW` in code.
- **Proto3 zero-value sentinels**: Enums whose upstream proto2 default isn't `0` (`Alert.Cause`, `Alert.Effect`, `Alert.SeverityLevel`) have an artificial `PROTO3_DEFAULT_*` at index 0. See Developer Notes below for the runtime patch that handles these.

# Changes required for GTFS-Realtime

``
src/Google/Protobuf/Internal/Message.php
method: existField
``

### Developer Notes

For GTFS-RT we need to serialize ENUMS even when they are the proto3 zero-value,
otherwise the wire format strips meaningful fields like `Incrementality`.

The following section must be present in the vendored
`src/Google/Protobuf/Internal/Message.php` after each regeneration or vendor update.

This is only required because the protobuf PHP generator doesn't account
for GTFS-Realtime using `0` for some ENUM defaults.

An example of this would be `Incrementality` within the `FeedHeader`.
Without this patch, the value `FULL_DATASET = 0` is stripped from the wire,
and downstream parsers receive `DIFFERENTIAL = 1` as the proto3 default — which
is almost never what the producer intended (the `DIFFERENTIAL` mode is still experimental).

The patch at **line 1597** of `src/Google/Protobuf/Internal/Message.php`:

```php
// Before (vanilla protobuf-php runtime):
if ($field->isMap()) {
    return count($values) !== 0;
} elseif ($field->isRepeated()) {
    return count($values) !== 0;
} else {
    return $values !== $this->defaultValue($field);
}
```

```php
// After (GTFS-RT patched):
if ($field->isMap()) {
    return count($values) !== 0;
} elseif ($field->isRepeated()) {
    return count($values) !== 0;
} else {
    if ($field->getType() === GPBType::ENUM) {
        // severity_level is special-cased to drop when unset, because
        // producers typically want "absent" rather than PROTO3_DEFAULT_SEVERITY_LEVEL.
        if ($field->getName() === 'severity_level' && empty($values)) {
            return false;
        }
        return true;
    } else {
        return $values !== $this->defaultValue($field);
    }
}
```

#### Behavior notes and asymmetries

- `severity_level` (Alert.SeverityLevel) is the only enum that's *suppressed* when unset.
- `cause` (Alert.Cause) and `effect` (Alert.Effect) use the same PROTO3_DEFAULT sentinel pattern but are *not* suppressed; they will always appear on the wire, carrying `PROTO3_DEFAULT_CAUSE`/`PROTO3_DEFAULT_EFFECT = 0` when unset.
- Enums whose proto3 zero is the legitimate default (`WheelchairAccessible.NO_VALUE`, `Stop.WheelchairBoarding.UNKNOWN`, `DropOffPickupType.REGULAR`, `OccupancyStatus.EMPTY`, etc.) will also always be serialized. This is a minor byte-size cost but semantically neutral.

`tests/Proto3EnumPatchRegressionTest.php` pins all of this behavior. If the
patch is reverted by a dependency update, those tests fail loudly.

#### Useful Links

- https://github.com/protocolbuffers/protobuf-php
- https://github.com/google/transit/blob/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/brians-code/gtfs-realtime-proto3
- https://raw.githubusercontent.com/google/transit/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/protocolbuffers/protobuf/releases
- https://github.com/protocolbuffers/protobuf/pull/8006/files
  - (hex2bin no longer used).

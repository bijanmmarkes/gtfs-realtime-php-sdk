# GTFS Realtime PHP SDK

---
This SDK is primarily using auto-generated files using the protoc command. There are some modifications put in place
which allow it to work with GTFS Realtime. An example of that would be the porting of the `gtfs-realtime.proto` file to `proto3` 
so that the protoc command actually works. There are also changes that allow us to use ENUM defaults that are `0` which aren't friendly with the proto standard. ex: `Incrementality FULL_DATASET` is overwritten
and defaulted to `DIFFERENTIAL` which is a big issue when creating feeds as it is currently
an experimental field and typically not used at all.

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

## Building it yourself

---
#### Generating new Files

- Installing required Packages:
```
composer require protobuf-php/protobuf --dev
composer require protobuf-php/protobuf-plugin --dev

```

```
php ./vendor/bin/protobuf --include-descriptors -i . -o ./src/gtfs ./protobuf/gtfs-realtime.proto

# Copy Files from gtfs to GtfsRealtime Directory to see DIFF in changes.
```

# Changes required for GTFS-Realtime:

``
src/Google/Protobuf/Internal/Message.php
method: existField
``


### Developer Notes

For GTFS-RT we need to add ENUMS even if there's a default value
otherwise it won't be considered valid.

The following section must be modified after each generation:

This is only required because the protobuf PHP generator doesn't account
for GTFS-Realtime using 0 for some ENUM defaults.

An example of this would be `Incrementality` within the `FeedHeader`.
Without this patch, it would default the Incrementality to `DIFFERENTIAL = 1` where in most
GTFS-RT Feeds, that is almost never the case, and `FULL_DATASET` is almost always used as the other field is still considered experimental.
This results in compiled feeds using the wrong `Incrementality` without the ability to change it.

```php
Line: 1597
  if ($field->isMap()) {
      return count($values) !== 0;
  } elseif ($field->isRepeated()) {
      return count($values) !== 0;
  } else {
     - return $values !== $this->defaultValue($field);
       + if ($field->getType() === GPBType::ENUM) {
       + // Account for new field "SeverityLevel" which has a default starting with 1.
       + if ($field->getName() === 'severity_level' && empty($values)) {
       +   return false;
       + }
       +   return true;
       + } else {
       +   return $values !== $this->defaultValue($field);
       + }
  }
```

```php
if ($field->getType() === GPBType::ENUM) {
    if ($field->getName() === 'severity_level' && empty($values)) {
      return false;
    }
    return true;
} else {
    return $values !== $this->defaultValue($field);
}
```


#### Useful Links:

- https://github.com/protocolbuffers/protobuf-php
- https://github.com/google/transit/blob/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/brians-code/gtfs-realtime-proto3
- https://raw.githubusercontent.com/google/transit/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/protocolbuffers/protobuf/releases
- https://github.com/protocolbuffers/protobuf/pull/8006/files 
  - (hex2bin no longer used).

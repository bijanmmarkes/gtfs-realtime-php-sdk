#### Generating new Files

```
php ./vendor/bin/protobuf --include-descriptors -i . -o ./src/gtfs ./protobuf/gtfs-realtime.proto
```

# Changes required for GTFS-Realtime:

``
src/Google/Protobuf/Internal/Message.php
method: existField
``

For GTFS-RT we need to add ENUMS even if there's a default value
otherwise it won't be considered valid.

The following section must be modified after each generation:

````php
Line: 1597
  if ($field->isMap()) {
      return count($values) !== 0;
  } elseif ($field->isRepeated()) {
      return count($values) !== 0;
  } else {
     - return $values !== $this->defaultValue($field);
       + if ($field->getType() === GPBType::ENUM) {
       +   return true;
       + } else {
       +   return $values !== $this->defaultValue($field);
       + }
  }
````


#### Useful Links:

- https://github.com/protocolbuffers/protobuf-php
- https://github.com/google/transit/blob/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/brians-code/gtfs-realtime-proto3
- https://raw.githubusercontent.com/google/transit/master/gtfs-realtime/proto/gtfs-realtime.proto
- https://github.com/protocolbuffers/protobuf/releases
- https://github.com/protocolbuffers/protobuf/pull/8006/files 
  - (hex2bin no longer used).

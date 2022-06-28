<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/gtfs-realtime.proto

namespace Google\Transit\Realtime;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Describes the physical path that a vehicle takes when it's not part of the (CSV) GTFS,
 * such as for a detour. Shapes belong to Trips, and consist of a sequence of shape points.
 * Tracing the points in order provides the path of the vehicle.  Shapes do not need to intercept
 * the location of Stops exactly, but all Stops on a trip should lie within a small distance of
 * the shape for that trip, i.e. close to straight line segments connecting the shape points
 * NOTE: This message is still experimental, and subject to change. It may be formally adopted in the future.
 *
 * Generated from protobuf message <code>google.transit.realtime.Shape</code>
 */
class Shape extends \Google\Protobuf\Internal\Message
{
    /**
     * Identifier of the shape. Must be different than any shape_id defined in the (CSV) GTFS.
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string shape_id = 1;</code>
     */
    protected $shape_id = '';
    /**
     * Encoded polyline representation of the shape. This polyline must contain at least two points.
     * For more information about encoded polylines, see https://developers.google.com/maps/documentation/utilities/polylinealgorithm
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string encoded_polyline = 2;</code>
     */
    protected $encoded_polyline = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $shape_id
     *           Identifier of the shape. Must be different than any shape_id defined in the (CSV) GTFS.
     *           This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     *           See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     *           NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *     @type string $encoded_polyline
     *           Encoded polyline representation of the shape. This polyline must contain at least two points.
     *           For more information about encoded polylines, see https://developers.google.com/maps/documentation/utilities/polylinealgorithm
     *           This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     *           See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     *           NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Protobuf\GtfsRealtime::initOnce();
        parent::__construct($data);
    }

    /**
     * Identifier of the shape. Must be different than any shape_id defined in the (CSV) GTFS.
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string shape_id = 1;</code>
     * @return string
     */
    public function getShapeId()
    {
        return $this->shape_id;
    }

    /**
     * Identifier of the shape. Must be different than any shape_id defined in the (CSV) GTFS.
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string shape_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setShapeId($var)
    {
        GPBUtil::checkString($var, True);
        $this->shape_id = $var;

        return $this;
    }

    /**
     * Encoded polyline representation of the shape. This polyline must contain at least two points.
     * For more information about encoded polylines, see https://developers.google.com/maps/documentation/utilities/polylinealgorithm
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string encoded_polyline = 2;</code>
     * @return string
     */
    public function getEncodedPolyline()
    {
        return $this->encoded_polyline;
    }

    /**
     * Encoded polyline representation of the shape. This polyline must contain at least two points.
     * For more information about encoded polylines, see https://developers.google.com/maps/documentation/utilities/polylinealgorithm
     * This field is required as per reference.md, but needs to be specified here optional because "Required is Forever"
     * See https://developers.google.com/protocol-buffers/docs/proto#specifying_field_rules
     * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>string encoded_polyline = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setEncodedPolyline($var)
    {
        GPBUtil::checkString($var, True);
        $this->encoded_polyline = $var;

        return $this;
    }

}


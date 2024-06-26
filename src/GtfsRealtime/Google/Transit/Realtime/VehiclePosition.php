<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/gtfs-realtime.proto

namespace Google\Transit\Realtime;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Realtime positioning information for a given vehicle.
 *
 * Generated from protobuf message <code>google.transit.realtime.VehiclePosition</code>
 */
class VehiclePosition extends \Google\Protobuf\Internal\Message
{
    /**
     * The Trip that this vehicle is serving.
     * Can be empty or partial if the vehicle can not be identified with a given
     * trip instance.
     * optional TripDescriptor trip = 1;
     *
     * Generated from protobuf field <code>.google.transit.realtime.TripDescriptor trip = 1;</code>
     */
    protected $trip = null;
    /**
     * Additional information on the vehicle that is serving this trip.
     * optional VehicleDescriptor vehicle = 8;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehicleDescriptor vehicle = 8;</code>
     */
    protected $vehicle = null;
    /**
     * Current position of this vehicle.
     * optional Position position = 2;
     *
     * Generated from protobuf field <code>.google.transit.realtime.Position position = 2;</code>
     */
    protected $position = null;
    /**
     * The stop sequence index of the current stop. The meaning of
     * current_stop_sequence (i.e., the stop that it refers to) is determined by
     * current_status.
     * If current_status is missing IN_TRANSIT_TO is assumed.
     * optional uint32 current_stop_sequence = 3;
     *
     * Generated from protobuf field <code>uint32 current_stop_sequence = 3;</code>
     */
    protected $current_stop_sequence = 0;
    /**
     * Identifies the current stop. The value must be the same as in stops.txt in
     * the corresponding GTFS feed.
     * optional string stop_id = 7;
     *
     * Generated from protobuf field <code>string stop_id = 7;</code>
     */
    protected $stop_id = '';
    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     * optional VehicleStopStatus current_status = 4 [default = IN_TRANSIT_TO];
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.VehicleStopStatus current_status = 4;</code>
     */
    protected $current_status = 0;
    /**
     * Moment at which the vehicle's position was measured. In POSIX time
     * (i.e., number of seconds since January 1st 1970 00:00:00 UTC).
     * optional uint64 timestamp = 5;
     *
     * Generated from protobuf field <code>uint64 timestamp = 5;</code>
     */
    protected $timestamp = 0;
    /**
     * optional CongestionLevel congestion_level = 6;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.CongestionLevel congestion_level = 6;</code>
     */
    protected $congestion_level = 0;
    /**
     * optional OccupancyStatus occupancy_status = 9;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.OccupancyStatus occupancy_status = 9;</code>
     */
    protected $occupancy_status = 0;
    /**
     * A percentage value indicating the degree of passenger occupancy in the vehicle.
     * The values are represented as an integer without decimals. 0 means 0% and 100 means 100%.
     * The value 100 should represent the total maximum occupancy the vehicle was designed for,
     * including both seated and standing capacity, and current operating regulations allow.
     * The value may exceed 100 if there are more passengers than the maximum designed capacity.
     * The precision of occupancy_percentage should be low enough that individual passengers cannot be tracked boarding or alighting the vehicle.
     * If multi_carriage_status is populated with per-carriage occupancy_percentage,
     * then this field should describe the entire vehicle with all carriages accepting passengers considered.
     * This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>uint32 occupancy_percentage = 10;</code>
     */
    protected $occupancy_percentage = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Transit\Realtime\TripDescriptor $trip
     *           The Trip that this vehicle is serving.
     *           Can be empty or partial if the vehicle can not be identified with a given
     *           trip instance.
     *           optional TripDescriptor trip = 1;
     *     @type \Google\Transit\Realtime\VehicleDescriptor $vehicle
     *           Additional information on the vehicle that is serving this trip.
     *           optional VehicleDescriptor vehicle = 8;
     *     @type \Google\Transit\Realtime\Position $position
     *           Current position of this vehicle.
     *           optional Position position = 2;
     *     @type int $current_stop_sequence
     *           The stop sequence index of the current stop. The meaning of
     *           current_stop_sequence (i.e., the stop that it refers to) is determined by
     *           current_status.
     *           If current_status is missing IN_TRANSIT_TO is assumed.
     *           optional uint32 current_stop_sequence = 3;
     *     @type string $stop_id
     *           Identifies the current stop. The value must be the same as in stops.txt in
     *           the corresponding GTFS feed.
     *           optional string stop_id = 7;
     *     @type int $current_status
     *           The exact status of the vehicle with respect to the current stop.
     *           Ignored if current_stop_sequence is missing.
     *           optional VehicleStopStatus current_status = 4 [default = IN_TRANSIT_TO];
     *     @type int|string $timestamp
     *           Moment at which the vehicle's position was measured. In POSIX time
     *           (i.e., number of seconds since January 1st 1970 00:00:00 UTC).
     *           optional uint64 timestamp = 5;
     *     @type int $congestion_level
     *           optional CongestionLevel congestion_level = 6;
     *     @type int $occupancy_status
     *           optional OccupancyStatus occupancy_status = 9;
     *     @type int $occupancy_percentage
     *           A percentage value indicating the degree of passenger occupancy in the vehicle.
     *           The values are represented as an integer without decimals. 0 means 0% and 100 means 100%.
     *           The value 100 should represent the total maximum occupancy the vehicle was designed for,
     *           including both seated and standing capacity, and current operating regulations allow.
     *           The value may exceed 100 if there are more passengers than the maximum designed capacity.
     *           The precision of occupancy_percentage should be low enough that individual passengers cannot be tracked boarding or alighting the vehicle.
     *           If multi_carriage_status is populated with per-carriage occupancy_percentage,
     *           then this field should describe the entire vehicle with all carriages accepting passengers considered.
     *           This field is still experimental, and subject to change. It may be formally adopted in the future.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Protobuf\GtfsRealtime::initOnce();
        parent::__construct($data);
    }

    /**
     * The Trip that this vehicle is serving.
     * Can be empty or partial if the vehicle can not be identified with a given
     * trip instance.
     * optional TripDescriptor trip = 1;
     *
     * Generated from protobuf field <code>.google.transit.realtime.TripDescriptor trip = 1;</code>
     * @return \Google\Transit\Realtime\TripDescriptor|null
     */
    public function getTrip()
    {
        return $this->trip;
    }

    public function hasTrip()
    {
        return isset($this->trip);
    }

    public function clearTrip()
    {
        unset($this->trip);
    }

    /**
     * The Trip that this vehicle is serving.
     * Can be empty or partial if the vehicle can not be identified with a given
     * trip instance.
     * optional TripDescriptor trip = 1;
     *
     * Generated from protobuf field <code>.google.transit.realtime.TripDescriptor trip = 1;</code>
     * @param \Google\Transit\Realtime\TripDescriptor $var
     * @return $this
     */
    public function setTrip($var)
    {
        GPBUtil::checkMessage($var, \Google\Transit\Realtime\TripDescriptor::class);
        $this->trip = $var;

        return $this;
    }

    /**
     * Additional information on the vehicle that is serving this trip.
     * optional VehicleDescriptor vehicle = 8;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehicleDescriptor vehicle = 8;</code>
     * @return \Google\Transit\Realtime\VehicleDescriptor|null
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function hasVehicle()
    {
        return isset($this->vehicle);
    }

    public function clearVehicle()
    {
        unset($this->vehicle);
    }

    /**
     * Additional information on the vehicle that is serving this trip.
     * optional VehicleDescriptor vehicle = 8;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehicleDescriptor vehicle = 8;</code>
     * @param \Google\Transit\Realtime\VehicleDescriptor $var
     * @return $this
     */
    public function setVehicle($var)
    {
        GPBUtil::checkMessage($var, \Google\Transit\Realtime\VehicleDescriptor::class);
        $this->vehicle = $var;

        return $this;
    }

    /**
     * Current position of this vehicle.
     * optional Position position = 2;
     *
     * Generated from protobuf field <code>.google.transit.realtime.Position position = 2;</code>
     * @return \Google\Transit\Realtime\Position|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function hasPosition()
    {
        return isset($this->position);
    }

    public function clearPosition()
    {
        unset($this->position);
    }

    /**
     * Current position of this vehicle.
     * optional Position position = 2;
     *
     * Generated from protobuf field <code>.google.transit.realtime.Position position = 2;</code>
     * @param \Google\Transit\Realtime\Position $var
     * @return $this
     */
    public function setPosition($var)
    {
        GPBUtil::checkMessage($var, \Google\Transit\Realtime\Position::class);
        $this->position = $var;

        return $this;
    }

    /**
     * The stop sequence index of the current stop. The meaning of
     * current_stop_sequence (i.e., the stop that it refers to) is determined by
     * current_status.
     * If current_status is missing IN_TRANSIT_TO is assumed.
     * optional uint32 current_stop_sequence = 3;
     *
     * Generated from protobuf field <code>uint32 current_stop_sequence = 3;</code>
     * @return int
     */
    public function getCurrentStopSequence()
    {
        return $this->current_stop_sequence;
    }

    /**
     * The stop sequence index of the current stop. The meaning of
     * current_stop_sequence (i.e., the stop that it refers to) is determined by
     * current_status.
     * If current_status is missing IN_TRANSIT_TO is assumed.
     * optional uint32 current_stop_sequence = 3;
     *
     * Generated from protobuf field <code>uint32 current_stop_sequence = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setCurrentStopSequence($var)
    {
        GPBUtil::checkUint32($var);
        $this->current_stop_sequence = $var;

        return $this;
    }

    /**
     * Identifies the current stop. The value must be the same as in stops.txt in
     * the corresponding GTFS feed.
     * optional string stop_id = 7;
     *
     * Generated from protobuf field <code>string stop_id = 7;</code>
     * @return string
     */
    public function getStopId()
    {
        return $this->stop_id;
    }

    /**
     * Identifies the current stop. The value must be the same as in stops.txt in
     * the corresponding GTFS feed.
     * optional string stop_id = 7;
     *
     * Generated from protobuf field <code>string stop_id = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setStopId($var)
    {
        GPBUtil::checkString($var, True);
        $this->stop_id = $var;

        return $this;
    }

    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     * optional VehicleStopStatus current_status = 4 [default = IN_TRANSIT_TO];
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.VehicleStopStatus current_status = 4;</code>
     * @return int
     */
    public function getCurrentStatus()
    {
        return $this->current_status;
    }

    /**
     * The exact status of the vehicle with respect to the current stop.
     * Ignored if current_stop_sequence is missing.
     * optional VehicleStopStatus current_status = 4 [default = IN_TRANSIT_TO];
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.VehicleStopStatus current_status = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setCurrentStatus($var)
    {
        GPBUtil::checkEnum($var, \Google\Transit\Realtime\VehiclePosition\VehicleStopStatus::class);
        $this->current_status = $var;

        return $this;
    }

    /**
     * Moment at which the vehicle's position was measured. In POSIX time
     * (i.e., number of seconds since January 1st 1970 00:00:00 UTC).
     * optional uint64 timestamp = 5;
     *
     * Generated from protobuf field <code>uint64 timestamp = 5;</code>
     * @return int|string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Moment at which the vehicle's position was measured. In POSIX time
     * (i.e., number of seconds since January 1st 1970 00:00:00 UTC).
     * optional uint64 timestamp = 5;
     *
     * Generated from protobuf field <code>uint64 timestamp = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimestamp($var)
    {
        GPBUtil::checkUint64($var);
        $this->timestamp = $var;

        return $this;
    }

    /**
     * optional CongestionLevel congestion_level = 6;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.CongestionLevel congestion_level = 6;</code>
     * @return int
     */
    public function getCongestionLevel()
    {
        return $this->congestion_level;
    }

    /**
     * optional CongestionLevel congestion_level = 6;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.CongestionLevel congestion_level = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setCongestionLevel($var)
    {
        GPBUtil::checkEnum($var, \Google\Transit\Realtime\VehiclePosition\CongestionLevel::class);
        $this->congestion_level = $var;

        return $this;
    }

    /**
     * optional OccupancyStatus occupancy_status = 9;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.OccupancyStatus occupancy_status = 9;</code>
     * @return int
     */
    public function getOccupancyStatus()
    {
        return $this->occupancy_status;
    }

    /**
     * optional OccupancyStatus occupancy_status = 9;
     *
     * Generated from protobuf field <code>.google.transit.realtime.VehiclePosition.OccupancyStatus occupancy_status = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setOccupancyStatus($var)
    {
        GPBUtil::checkEnum($var, \Google\Transit\Realtime\VehiclePosition\OccupancyStatus::class);
        $this->occupancy_status = $var;

        return $this;
    }

    /**
     * A percentage value indicating the degree of passenger occupancy in the vehicle.
     * The values are represented as an integer without decimals. 0 means 0% and 100 means 100%.
     * The value 100 should represent the total maximum occupancy the vehicle was designed for,
     * including both seated and standing capacity, and current operating regulations allow.
     * The value may exceed 100 if there are more passengers than the maximum designed capacity.
     * The precision of occupancy_percentage should be low enough that individual passengers cannot be tracked boarding or alighting the vehicle.
     * If multi_carriage_status is populated with per-carriage occupancy_percentage,
     * then this field should describe the entire vehicle with all carriages accepting passengers considered.
     * This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>uint32 occupancy_percentage = 10;</code>
     * @return int
     */
    public function getOccupancyPercentage()
    {
        return $this->occupancy_percentage;
    }

    /**
     * A percentage value indicating the degree of passenger occupancy in the vehicle.
     * The values are represented as an integer without decimals. 0 means 0% and 100 means 100%.
     * The value 100 should represent the total maximum occupancy the vehicle was designed for,
     * including both seated and standing capacity, and current operating regulations allow.
     * The value may exceed 100 if there are more passengers than the maximum designed capacity.
     * The precision of occupancy_percentage should be low enough that individual passengers cannot be tracked boarding or alighting the vehicle.
     * If multi_carriage_status is populated with per-carriage occupancy_percentage,
     * then this field should describe the entire vehicle with all carriages accepting passengers considered.
     * This field is still experimental, and subject to change. It may be formally adopted in the future.
     *
     * Generated from protobuf field <code>uint32 occupancy_percentage = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setOccupancyPercentage($var)
    {
        GPBUtil::checkUint32($var);
        $this->occupancy_percentage = $var;

        return $this;
    }

}


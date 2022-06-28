<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/gtfs-realtime.proto

namespace Google\Transit\Realtime\VehiclePosition;

use UnexpectedValueException;

/**
 * The degree of passenger occupancy of the vehicle. This field is still
 * experimental, and subject to change. It may be formally adopted in the
 * future.
 *
 * Protobuf type <code>google.transit.realtime.VehiclePosition.OccupancyStatus</code>
 */
class OccupancyStatus
{
    /**
     * The vehicle is considered empty by most measures, and has few or no
     * passengers onboard, but is still accepting passengers.
     *
     * Generated from protobuf enum <code>EMPTY = 0;</code>
     */
    const PBEMPTY = 0;
    /**
     * The vehicle has a relatively large percentage of seats available.
     * What percentage of free seats out of the total seats available is to be
     * considered large enough to fall into this category is determined at the
     * discretion of the producer.
     *
     * Generated from protobuf enum <code>MANY_SEATS_AVAILABLE = 1;</code>
     */
    const MANY_SEATS_AVAILABLE = 1;
    /**
     * The vehicle has a relatively small percentage of seats available.
     * What percentage of free seats out of the total seats available is to be
     * considered small enough to fall into this category is determined at the
     * discretion of the feed producer.
     *
     * Generated from protobuf enum <code>FEW_SEATS_AVAILABLE = 2;</code>
     */
    const FEW_SEATS_AVAILABLE = 2;
    /**
     * The vehicle can currently accommodate only standing passengers.
     *
     * Generated from protobuf enum <code>STANDING_ROOM_ONLY = 3;</code>
     */
    const STANDING_ROOM_ONLY = 3;
    /**
     * The vehicle can currently accommodate only standing passengers
     * and has limited space for them.
     *
     * Generated from protobuf enum <code>CRUSHED_STANDING_ROOM_ONLY = 4;</code>
     */
    const CRUSHED_STANDING_ROOM_ONLY = 4;
    /**
     * The vehicle is considered full by most measures, but may still be
     * allowing passengers to board.
     *
     * Generated from protobuf enum <code>FULL = 5;</code>
     */
    const FULL = 5;
    /**
     * The vehicle is not accepting additional passengers.
     *
     * Generated from protobuf enum <code>NOT_ACCEPTING_PASSENGERS = 6;</code>
     */
    const NOT_ACCEPTING_PASSENGERS = 6;

    private static $valueToName = [
        self::PBEMPTY => 'PBEMPTY',
        self::MANY_SEATS_AVAILABLE => 'MANY_SEATS_AVAILABLE',
        self::FEW_SEATS_AVAILABLE => 'FEW_SEATS_AVAILABLE',
        self::STANDING_ROOM_ONLY => 'STANDING_ROOM_ONLY',
        self::CRUSHED_STANDING_ROOM_ONLY => 'CRUSHED_STANDING_ROOM_ONLY',
        self::FULL => 'FULL',
        self::NOT_ACCEPTING_PASSENGERS => 'NOT_ACCEPTING_PASSENGERS',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OccupancyStatus::class, \Google\Transit\Realtime\VehiclePosition_OccupancyStatus::class);


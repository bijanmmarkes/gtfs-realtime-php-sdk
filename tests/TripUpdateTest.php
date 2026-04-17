<?php

declare(strict_types=1);

namespace BijanMMarkes\GtfsRealtime\Tests;

use Google\Transit\Realtime\TripUpdate;
use Google\Transit\Realtime\TripUpdate\StopTimeEvent;
use Google\Transit\Realtime\TripUpdate\StopTimeUpdate;
use Google\Transit\Realtime\TripUpdate\StopTimeUpdate\ScheduleRelationship;
use Google\Transit\Realtime\TripUpdate\StopTimeUpdate\StopTimeProperties;
use Google\Transit\Realtime\TripUpdate\StopTimeUpdate\StopTimeProperties\DropOffPickupType;
use Google\Transit\Realtime\TripUpdate\TripProperties;
use Google\Transit\Realtime\TripDescriptor;
use PHPUnit\Framework\TestCase;

final class TripUpdateTest extends TestCase
{
    public function testStopTimeEventScheduledTime(): void
    {
        $event = new StopTimeEvent();
        $event->setDelay(60);
        $event->setScheduledTime(1_700_000_000);

        $decoded = new StopTimeEvent();
        $decoded->mergeFromString($event->serializeToString());

        self::assertSame(60, $decoded->getDelay());
        self::assertSame(1_700_000_000, $decoded->getScheduledTime());
    }

    public function testStopTimeUpdateUnscheduledAndDepartureOccupancy(): void
    {
        self::assertSame(3, ScheduleRelationship::UNSCHEDULED);

        $update = new StopTimeUpdate();
        $update->setStopSequence(5);
        $update->setScheduleRelationship(ScheduleRelationship::UNSCHEDULED);
        $update->setDepartureOccupancyStatus(\Google\Transit\Realtime\VehiclePosition\OccupancyStatus::CRUSHED_STANDING_ROOM_ONLY);

        $decoded = new StopTimeUpdate();
        $decoded->mergeFromString($update->serializeToString());

        self::assertSame(ScheduleRelationship::UNSCHEDULED, $decoded->getScheduleRelationship());
        self::assertSame(
            \Google\Transit\Realtime\VehiclePosition\OccupancyStatus::CRUSHED_STANDING_ROOM_ONLY,
            $decoded->getDepartureOccupancyStatus()
        );
    }

    public function testStopTimePropertiesWithDropOffPickupType(): void
    {
        $props = new StopTimeProperties();
        $props->setAssignedStopId('stop-42');
        $props->setPickupType(DropOffPickupType::NONE);
        $props->setDropOffType(DropOffPickupType::PHONE_AGENCY);

        $update = new StopTimeUpdate();
        $update->setStopTimeProperties($props);

        $decoded = new StopTimeUpdate();
        $decoded->mergeFromString($update->serializeToString());

        $decodedProps = $decoded->getStopTimeProperties();
        self::assertNotNull($decodedProps);
        self::assertSame('stop-42', $decodedProps->getAssignedStopId());
        self::assertSame(DropOffPickupType::NONE, $decodedProps->getPickupType());
        self::assertSame(DropOffPickupType::PHONE_AGENCY, $decodedProps->getDropOffType());
    }

    public function testTripPropertiesRoundTrip(): void
    {
        $props = new TripProperties();
        $props->setTripId('t-100');
        $props->setStartDate('20260417');
        $props->setStartTime('08:30:00');
        $props->setShapeId('shape-7');
        $props->setTripHeadsign('Downtown');
        $props->setTripShortName('A1');

        $update = new TripUpdate();
        $update->setTrip(new TripDescriptor(['trip_id' => 't-100']));
        $update->setTripProperties($props);

        $decoded = new TripUpdate();
        $decoded->mergeFromString($update->serializeToString());

        $p = $decoded->getTripProperties();
        self::assertSame('t-100', $p->getTripId());
        self::assertSame('20260417', $p->getStartDate());
        self::assertSame('Downtown', $p->getTripHeadsign());
        self::assertSame('A1', $p->getTripShortName());
    }

    public function testTripDescriptorExtendedScheduleRelationships(): void
    {
        // NEW=8 is renamed to PBNEW by protoc (PHP reserved word).
        self::assertSame(5, TripDescriptor\ScheduleRelationship::REPLACEMENT);
        self::assertSame(6, TripDescriptor\ScheduleRelationship::DUPLICATED);
        self::assertSame(7, TripDescriptor\ScheduleRelationship::DELETED);
        self::assertSame(8, TripDescriptor\ScheduleRelationship::PBNEW);
    }
}

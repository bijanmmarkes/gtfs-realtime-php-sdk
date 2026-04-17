<?php

declare(strict_types=1);

namespace BijanMMarkes\GtfsRealtime\Tests;

use Google\Transit\Realtime\Position;
use Google\Transit\Realtime\VehicleDescriptor;
use Google\Transit\Realtime\VehicleDescriptor\WheelchairAccessible;
use Google\Transit\Realtime\VehiclePosition;
use Google\Transit\Realtime\VehiclePosition\CarriageDetails;
use PHPUnit\Framework\TestCase;

final class VehiclePositionTest extends TestCase
{
    public function testVehicleDescriptorWheelchairAccessible(): void
    {
        self::assertSame(0, WheelchairAccessible::NO_VALUE);
        self::assertSame(1, WheelchairAccessible::UNKNOWN);
        self::assertSame(2, WheelchairAccessible::WHEELCHAIR_ACCESSIBLE);
        self::assertSame(3, WheelchairAccessible::WHEELCHAIR_INACCESSIBLE);

        $desc = new VehicleDescriptor();
        $desc->setId('bus-7');
        $desc->setWheelchairAccessible(WheelchairAccessible::WHEELCHAIR_ACCESSIBLE);

        $decoded = new VehicleDescriptor();
        $decoded->mergeFromString($desc->serializeToString());

        self::assertSame('bus-7', $decoded->getId());
        self::assertSame(
            WheelchairAccessible::WHEELCHAIR_ACCESSIBLE,
            $decoded->getWheelchairAccessible()
        );
    }

    public function testMultiCarriageDetailsRoundTrip(): void
    {
        $car1 = new CarriageDetails();
        $car1->setId('car-1');
        $car1->setLabel('Front');
        $car1->setOccupancyStatus(VehiclePosition\OccupancyStatus::MANY_SEATS_AVAILABLE);
        $car1->setCarriageSequence(1);

        $car2 = new CarriageDetails();
        $car2->setId('car-2');
        $car2->setLabel('Rear');
        $car2->setOccupancyStatus(VehiclePosition\OccupancyStatus::FULL);
        $car2->setCarriageSequence(2);

        $vp = new VehiclePosition();
        $vp->setPosition(new Position(['latitude' => 40.7, 'longitude' => -74.0]));
        $vp->setMultiCarriageDetails([$car1, $car2]);

        $decoded = new VehiclePosition();
        $decoded->mergeFromString($vp->serializeToString());

        $cars = iterator_to_array($decoded->getMultiCarriageDetails());
        self::assertCount(2, $cars);
        self::assertSame('car-1', $cars[0]->getId());
        self::assertSame('Front', $cars[0]->getLabel());
        self::assertSame(
            VehiclePosition\OccupancyStatus::MANY_SEATS_AVAILABLE,
            $cars[0]->getOccupancyStatus()
        );
        self::assertSame(2, $cars[1]->getCarriageSequence());
    }
}

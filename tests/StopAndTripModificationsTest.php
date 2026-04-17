<?php

declare(strict_types=1);

namespace BijanMMarkes\GtfsRealtime\Tests;

use Google\Transit\Realtime\FeedEntity;
use Google\Transit\Realtime\FeedHeader;
use Google\Transit\Realtime\FeedHeader\Incrementality;
use Google\Transit\Realtime\FeedMessage;
use Google\Transit\Realtime\ReplacementStop;
use Google\Transit\Realtime\Stop;
use Google\Transit\Realtime\Stop\WheelchairBoarding;
use Google\Transit\Realtime\StopSelector;
use Google\Transit\Realtime\TranslatedString;
use Google\Transit\Realtime\TranslatedString\Translation;
use Google\Transit\Realtime\TripDescriptor\ModifiedTripSelector;
use Google\Transit\Realtime\TripModifications;
use Google\Transit\Realtime\TripModifications\Modification;
use Google\Transit\Realtime\TripModifications\SelectedTrips;
use PHPUnit\Framework\TestCase;

final class StopAndTripModificationsTest extends TestCase
{
    public function testStopRoundTrip(): void
    {
        self::assertSame(0, WheelchairBoarding::UNKNOWN);
        self::assertSame(1, WheelchairBoarding::AVAILABLE);
        self::assertSame(2, WheelchairBoarding::NOT_AVAILABLE);

        $name = new TranslatedString([
            'translation' => [new Translation(['text' => 'Central Station', 'language' => 'en'])],
        ]);
        $code = new TranslatedString([
            'translation' => [new Translation(['text' => '001', 'language' => 'en'])],
        ]);

        $stop = new Stop();
        $stop->setStopId('stop-1');
        $stop->setStopCode($code);
        $stop->setStopName($name);
        $stop->setStopLat(40.7128);
        $stop->setStopLon(-74.0060);
        $stop->setWheelchairBoarding(WheelchairBoarding::AVAILABLE);

        $decoded = new Stop();
        $decoded->mergeFromString($stop->serializeToString());

        self::assertSame('stop-1', $decoded->getStopId());
        self::assertSame('001', $decoded->getStopCode()->getTranslation()[0]->getText());
        self::assertEqualsWithDelta(40.7128, $decoded->getStopLat(), 0.0001);
        self::assertEqualsWithDelta(-74.0060, $decoded->getStopLon(), 0.0001);
        self::assertSame(WheelchairBoarding::AVAILABLE, $decoded->getWheelchairBoarding());
        self::assertSame(
            'Central Station',
            $decoded->getStopName()->getTranslation()[0]->getText()
        );
    }

    public function testTripModificationsRoundTrip(): void
    {
        $selector = new StopSelector();
        $selector->setStopId('stop-9');

        $replacement = new ReplacementStop();
        $replacement->setStopId('stop-temp');
        $replacement->setTravelTimeToStop(120);

        $modification = new Modification();
        $modification->setStartStopSelector(new StopSelector(['stop_id' => 'stop-3']));
        $modification->setEndStopSelector(new StopSelector(['stop_id' => 'stop-7']));
        $modification->setPropagatedModificationDelay(300);
        $modification->setReplacementStops([$replacement]);

        $selectedTrips = new SelectedTrips();
        $selectedTrips->setTripIds(['t-1', 't-2']);
        $selectedTrips->setShapeId('shape-replacement');

        $mods = new TripModifications();
        $mods->setSelectedTrips([$selectedTrips]);
        $mods->setModifications([$modification]);
        $mods->setServiceDates(['20260417']);

        $decoded = new TripModifications();
        $decoded->mergeFromString($mods->serializeToString());

        $decodedMods = iterator_to_array($decoded->getModifications());
        self::assertCount(1, $decodedMods);
        self::assertSame(300, $decodedMods[0]->getPropagatedModificationDelay());
        self::assertSame(
            'stop-3',
            $decodedMods[0]->getStartStopSelector()->getStopId()
        );

        $decodedTrips = iterator_to_array($decoded->getSelectedTrips());
        self::assertSame('shape-replacement', $decodedTrips[0]->getShapeId());
        self::assertSame(['t-1', 't-2'], iterator_to_array($decodedTrips[0]->getTripIds()));
    }

    public function testFeedEntityCarriesShapeStopAndTripModifications(): void
    {
        $stop = new Stop(['stop_id' => 'stop-1', 'stop_lat' => 1.0, 'stop_lon' => 2.0]);
        $entity = new FeedEntity();
        $entity->setId('e-1');
        $entity->setStop($stop);

        $message = new FeedMessage();
        $message->setHeader(new FeedHeader([
            'gtfs_realtime_version' => '2.0',
            'incrementality' => Incrementality::FULL_DATASET,
            'timestamp' => 123,
            'feed_version' => 'v42',
        ]));
        $message->setEntity([$entity]);

        $decoded = new FeedMessage();
        $decoded->mergeFromString($message->serializeToString());

        self::assertSame('v42', $decoded->getHeader()->getFeedVersion());
        $decodedEntity = iterator_to_array($decoded->getEntity())[0];
        self::assertSame('stop-1', $decodedEntity->getStop()->getStopId());
    }

    public function testModifiedTripSelectorOnTripDescriptor(): void
    {
        $selector = new ModifiedTripSelector();
        $selector->setModificationsId('mod-1');
        $selector->setAffectedTripId('trip-original');

        $decoded = new ModifiedTripSelector();
        $decoded->mergeFromString($selector->serializeToString());

        self::assertSame('mod-1', $decoded->getModificationsId());
        self::assertSame('trip-original', $decoded->getAffectedTripId());
    }
}

<?php

declare(strict_types=1);

namespace BijanMMarkes\GtfsRealtime\Tests;

use Google\Transit\Realtime\Alert;
use Google\Transit\Realtime\Alert\Cause;
use Google\Transit\Realtime\Alert\Effect;
use Google\Transit\Realtime\TranslatedString;
use Google\Transit\Realtime\TranslatedString\Translation;
use PHPUnit\Framework\TestCase;

/**
 * Verifies Alert message carries the new cause_detail / effect_detail fields
 * and the custom SPECIAL_EVENT cause value (field 13, not in upstream spec).
 */
final class AlertTest extends TestCase
{
    public function testCustomSpecialEventCauseValueExists(): void
    {
        self::assertSame(13, Cause::SPECIAL_EVENT);
    }

    public function testAlertRoundTripsCauseAndEffectDetail(): void
    {
        $causeDetail = new TranslatedString([
            'translation' => [new Translation(['text' => 'Annual parade', 'language' => 'en'])],
        ]);
        $effectDetail = new TranslatedString([
            'translation' => [new Translation(['text' => 'Buses rerouted around downtown', 'language' => 'en'])],
        ]);

        $alert = new Alert();
        $alert->setCause(Cause::SPECIAL_EVENT);
        $alert->setEffect(Effect::DETOUR);
        $alert->setCauseDetail($causeDetail);
        $alert->setEffectDetail($effectDetail);

        $bytes = $alert->serializeToString();
        self::assertNotEmpty($bytes);

        $decoded = new Alert();
        $decoded->mergeFromString($bytes);

        self::assertSame(Cause::SPECIAL_EVENT, $decoded->getCause());
        self::assertSame(Effect::DETOUR, $decoded->getEffect());
        self::assertSame(
            'Annual parade',
            $decoded->getCauseDetail()->getTranslation()[0]->getText()
        );
        self::assertSame(
            'Buses rerouted around downtown',
            $decoded->getEffectDetail()->getTranslation()[0]->getText()
        );
    }

    public function testUpstreamCauseValuesRemainStable(): void
    {
        // Regression: custom SPECIAL_EVENT must not shift upstream values.
        self::assertSame(1, Cause::UNKNOWN_CAUSE);
        self::assertSame(2, Cause::OTHER_CAUSE);
        self::assertSame(12, Cause::MEDICAL_EMERGENCY);
    }
}

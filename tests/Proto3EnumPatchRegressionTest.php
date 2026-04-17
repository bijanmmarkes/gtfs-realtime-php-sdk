<?php

declare(strict_types=1);

namespace BijanMMarkes\GtfsRealtime\Tests;

use Google\Transit\Realtime\Alert;
use Google\Transit\Realtime\Alert\SeverityLevel;
use Google\Transit\Realtime\FeedHeader;
use Google\Transit\Realtime\FeedHeader\Incrementality;
use PHPUnit\Framework\TestCase;

/**
 * Pins the behavior of the local patch in src/Google/Protobuf/Internal/Message.php
 * around line 1597 (existField override for ENUMs).
 *
 * Without the patch, proto3 treats an unset enum as "value 0" and strips it from
 * the wire. This breaks Incrementality (0=FULL_DATASET is the real default, but
 * proto strips it so consumers can't tell it was explicitly set), and also
 * Cause/Effect/SeverityLevel which use PROTO3_DEFAULT_* sentinels at index 0.
 *
 * The patch force-serializes ALL enum fields except `severity_level` when empty,
 * which stays 0 only if explicitly "not set" (legacy: severity_level was the
 * motivating case).
 *
 * If these tests break, the patch in Message.php:~1597 was likely clobbered by
 * a composer install / package update. Re-apply it from README Developer Notes.
 */
final class Proto3EnumPatchRegressionTest extends TestCase
{
    public function testIncrementalityFullDatasetIsSerialized(): void
    {
        $header = new FeedHeader();
        $header->setGtfsRealtimeVersion('2.0');
        $header->setIncrementality(Incrementality::FULL_DATASET); // value 0

        $bytes = $header->serializeToString();

        // Without the patch, the value-0 enum field would be stripped.
        // With the patch, it's force-serialized and a decoder can read it back.
        $decoded = new FeedHeader();
        $decoded->mergeFromString($bytes);

        self::assertSame(Incrementality::FULL_DATASET, $decoded->getIncrementality());
        // Field tag for `incrementality` (varint, field 2) should be present.
        // Tag byte for field 2 varint = (2 << 3) | 0 = 0x10
        self::assertStringContainsString("\x10", $bytes);
    }

    public function testSeverityLevelUnsetIsNotSerialized(): void
    {
        $alert = new Alert();
        // Do not set severity_level at all.
        $bytes = $alert->serializeToString();

        // Patch special-cases severity_level (field 10) to NOT serialize when empty/0.
        // Field 10 varint tag = (10 << 3) | 0 = 0x50.
        // Cause (field 6, tag 0x30) and Effect (field 7, tag 0x38) WILL appear
        // because the patch force-serializes all other enums; those carry their
        // PROTO3_DEFAULT_* sentinel value 0.
        self::assertStringNotContainsString("\x50", $bytes);
        self::assertStringContainsString("\x30", $bytes);
        self::assertStringContainsString("\x38", $bytes);
    }

    public function testSeverityLevelExplicitValueIsSerialized(): void
    {
        $alert = new Alert();
        $alert->setSeverityLevel(SeverityLevel::SEVERE);

        $decoded = new Alert();
        $decoded->mergeFromString($alert->serializeToString());

        self::assertSame(SeverityLevel::SEVERE, $decoded->getSeverityLevel());
    }
}

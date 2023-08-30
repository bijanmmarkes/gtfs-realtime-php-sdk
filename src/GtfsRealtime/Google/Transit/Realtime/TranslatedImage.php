<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/gtfs-realtime.proto

namespace Google\Transit\Realtime;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Transit\Realtime\TranslatedImage\LocalizedImage;

/**
 * An internationalized image containing per-language versions of a URL linking to an image
 * along with meta information
 * Only one of the images from a message will be retained by consumers. The resolution proceeds
 * as follows:
 * 1. If the UI language matches the language code of a translation,
 *    the first matching translation is picked.
 * 2. If a default UI language (e.g., English) matches the language code of a
 *    translation, the first matching translation is picked.
 * 3. If some translation has an unspecified language code, that translation is
 *    picked.
 * NOTE: This field is still experimental, and subject to change. It may be formally adopted in the future.
 *
 * Generated from protobuf message <code>google.transit.realtime.TranslatedImage</code>
 */
class TranslatedImage extends \Google\Protobuf\Internal\Message
{
    /**
     * At least one localized image must be provided.
     *
     * Generated from protobuf field <code>.google.transit.realtime.TranslatedImage.LocalizedImage localized_image = 1;</code>
     */
    protected $localized_image = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type LocalizedImage[]|RepeatedField $localized_image
     *           At least one localized image must be provided.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Protobuf\GtfsRealtime::initOnce();
        parent::__construct($data);
    }

    /**
     * At least one localized image must be provided.
     *
     * Generated from protobuf field <code>.google.transit.realtime.TranslatedImage.LocalizedImage localized_image = 1;</code>
     * @return LocalizedImage[]|RepeatedField|null
     */
    public function getLocalizedImage()
    {
        return $this->localized_image;
    }

    public function hasLocalizedImage(): bool
    {
        return isset($this->localized_image);
    }

    public function clearLocalizedImage()
    {
        unset($this->localized_image);
    }

    /**
     * At least one localized image must be provided.
     *
     * Generated from protobuf field <code>.google.transit.realtime.TranslatedImage.LocalizedImage localized_image = 1;</code>
     * @param LocalizedImage[]|RepeatedField $var
     * @return TranslatedImage
     * @throws \Exception
     */
    public function setLocalizedImage($var): TranslatedImage
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, LocalizedImage::class);
        $this->localized_image = $arr;

        return $this;
    }

}
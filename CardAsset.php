<?php

namespace FalloutGrabber;

class CardAsset
{
    const path = "storage/";

    private $url;
    private $cardWidth;
    private $cardHeight;
    private $extension;
    private $altUrl;
    private $cardType;

    /**
     * CardAsset constructor.
     * @param array $asset
     */
    public function __construct(array $asset) {
        $this->cardHeight = $asset[0];
        $this->cardWidth = $asset[1];
        $this->url = $asset[2];
        $this->altUrl = self::path . $asset[6];
        $this->extension = $asset[5];
        $this->cardType = $asset[7];
    }

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getCardWidth() {
        return $this->cardWidth;
    }

    /**
     * @return mixed
     */
    public function getCardHeight() {
        return $this->cardHeight;
    }

    public function getExtension() {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getAltUrl(): string {
        return $this->altUrl;
    }

    /**
     * @return mixed
     */
    public function getCardType() {
        return $this->cardType;
    }

}
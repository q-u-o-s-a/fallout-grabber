<?php

namespace FalloutGrabber;

use RuntimeException;

class CardAsset
{
    const path = "storage/";

    private $url;
    private $urlPrefix;
    private $cardWidth;
    private $cardHeight;
    private $extension;
    private string $altUrl;
    private $cardType;

    /**
     * CardAsset constructor.
     * @param array $asset
     */
    public function __construct(array $asset,$urlPrefix) {
        $this->cardHeight = $asset[0];
        $this->cardWidth = $asset[1];
        $this->url = $asset[2];
        $this->urlPrefix = $urlPrefix;
        $this->altUrl = self::path . $asset[6];
        $this->extension = $asset[5];
        $this->cardType = $asset[7];

        if (!is_dir(self::path)) {
            if (!mkdir(self::path, 0777, true) && !is_dir(self::path)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', self::path));
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->urlPrefix.$this->url;
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
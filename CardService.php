<?php

namespace FalloutGrabber;

use RuntimeException;

class CardService
{
    public const path = "storage/imageCache/";

    /**
     * @var string
     */
    private string $fullCardPath;

    public function getImage($startXPosition, $startYPosition, CardAsset $cardAsset) {

        if (!extension_loaded('gd')) {
            throw new RuntimeException('GD Library not loaded');
        }

        if (!file_exists($cardAsset->getAltUrl())) {
            if (!imagejpeg(imagecreatefromstring(file_get_contents($cardAsset->getUrl())), $cardAsset->getAltUrl())) {
                throw new RuntimeException('Source not found, local source:'
                    . $cardAsset->getAltUrl() . ', check if exists:' . file_exists($cardAsset->getAltUrl()
                        . "; remote source:" . $cardAsset->getUrl() . ", check if exists:"
                        . $this->urlExists($cardAsset->getUrl()) . ";"));
            }
        }
        $im = imagecreatefromjpeg($cardAsset->getAltUrl());

        $result = imagecrop($im, [
            'x' => $startXPosition,
            'y' => $startYPosition,
            'width' => $cardAsset->getCardWidth(),
            'height' => $cardAsset->getCardHeight()
        ]);
        imagedestroy($im);
        return $result;
    }

    public function urlExists($url): bool {
        $file_headers = @get_headers($url);
        if (!$file_headers || (string)$file_headers[0] === 'HTTP/1.1 404 Not Found') {
            $exists = false;
        } else {
            $exists = true;
        }
        return $exists;
    }

    /**
     * @param int $cardColumn
     * @param int $cardRow
     * @param CardAsset $cardAsset
     */
    public function getCrop(int $cardColumn, int $cardRow, CardAsset $cardAsset): void {
        $startXPosition = (($cardColumn) * $cardAsset->getCardWidth());
        $startYPosition = ($cardRow * $cardAsset->getCardHeight());

        $path = self::path . $cardAsset->getCardType();
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }

        $image = $this->getImage($startXPosition, $startYPosition, $cardAsset);

        if (!empty($image)) {
            imagepng($image, $this->fullCardPath);
        }
    }

    public function getCard(int $cardNr, $cardAsset, $cardsPerRow): void {
        $cardRow = floor($cardNr / $cardsPerRow);
        $cardColumn = $cardNr % $cardsPerRow;

        $this->fullCardPath = self::path . $cardAsset->getCardType() . "/" .
            $cardRow . "-" . $cardColumn . ".png";

        if (!file_exists($this->fullCardPath)) {
            $this->getCrop($cardColumn, $cardRow, $cardAsset);
        }
    }
}
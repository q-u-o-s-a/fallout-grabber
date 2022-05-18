<?php

namespace FalloutGrabber;

class CardService
{
    const path = "storage/imageCache/";

    private $fullCardPath;

    function getImage($startXPosition, $startYPosition, CardAsset $cardAsset) {

        if (!$this->url_exists($cardAsset->getUrl())) {
            if ($cardAsset->getExtension() == "png") {

                $im = imagecreatefrompng($cardAsset->getAltUrl());
            } else {
                $im = imagecreatefromjpeg($cardAsset->getAltUrl());
            }
        } else {
            if ($cardAsset->getExtension() == "png") {
                $im = imagecreatefrompng($cardAsset->getUrl());
            } else {
                $im = imagecreatefromjpeg($cardAsset->getUrl());
            }
        }

        $result = imagecrop($im, ['x' => $startXPosition, 'y' => $startYPosition,
            'width' => $cardAsset->getCardWidth(), 'height' => $cardAsset->getCardHeight()]);
        imagedestroy($im);
        return $result;
    }

    function url_exists($url): bool {
        $file_headers = @get_headers($url);
        if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
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
    function getCrop(int $cardColumn, int $cardRow, CardAsset $cardAsset) {
        $startXPosition = (($cardColumn) * $cardAsset->getCardWidth());
        $startYPosition = ($cardRow * $cardAsset->getCardHeight());

        if (!is_dir(self::path . $cardAsset->getCardType())) {
            mkdir(self::path . $cardAsset->getCardType());
        }

        $image = $this->getImage($startXPosition, $startYPosition, $cardAsset);

        if (!empty($image)) {
            imagepng($image, $this->fullCardPath);
        }
    }

    public function getCard(int $cardNr, $cardAsset, $cardsPerRow) {
        $cardRow = floor($cardNr / $cardsPerRow);
        $cardColumn = $cardNr % $cardsPerRow;

        $this->fullCardPath = self::path . $cardAsset->getCardType() . "/" .
            $cardRow . "-" . $cardColumn . ".png";

        if (!file_exists($this->fullCardPath)) {
            $this->getCrop($cardColumn, $cardRow, $cardAsset);
        }

    }

    /**
     * @return mixed
     */
    public function getFullCardPath() {
        return $this->fullCardPath;
    }
}
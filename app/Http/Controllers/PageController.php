<?php /** @noinspection PhpUnused */


namespace FalloutGrabber;

use Imagick;
use ImagickException;
use RuntimeException;

class PageController extends AbstractController
{
    public function loadCardAction($attributes): void {
        if (isset($this->attributes->set)) {
            $set = $this->attributes->set;

            $cardRepository = new CardRepository();
            $assets = $cardRepository->getAssets();
            $setNr = $cardRepository->getAssetNrByAssetName($set);

            $cardAsset = new CardAsset(
                $assets[$setNr],
                $cardRepository->getUrlPrefix()
            );

            $cardService = new CardService();
            $cardService->getCard($this->attributes->cardNr, $cardAsset,
                $assets[$setNr][4]);

            $storyCard = $cardRepository->getCardBySetNr($setNr, $this->attributes->cardNr);

            $this->view->assign('name', "X");
            $this->view->assign('size', "2");
            $this->view->assign('card', $storyCard);
        }
    }

    public function overviewAction(): void {
        $cardRepository = new CardRepository();
        $this->view->assign('navItems', $cardRepository->getAssetCardTypes());
        $this->view->assign('set', "Overview");
    }

    public function overviewSetAction(): void {
        $cardRepository = new CardRepository();
        $this->view->assign('navItems', $cardRepository->getAssetCardTypes());
        $this->view->assign('set', $this->attributes->set);
        $this->view->assign('size', 2);
    }

    public function showCardSetAction(): void {
        if (isset($this->attributes->set)) {
            $cardRepository = new CardRepository();
            $this->view->content($this->view->overviewLeftNavigation(
                $cardRepository->getAssetCardTypes(),
                $this->attributes->set,
                $this->view->showCardSet($this->attributes->set, $cardRepository->getAsset($this->attributes->set))));
        }
    }

    public function downloadSetAction(): void {
        if (isset($this->attributes->set)) {
            $cardRepository = new CardRepository();
            $cardAsset = new CardAsset(
                $cardRepository->getAsset($this->attributes->set),
                $cardRepository->getUrlPrefix());

            if (is_file($cardAsset->getAltUrl())) {
                echo "&nbsp;Set already downloaded";
                die();
            }

            echo "&nbsp;Try to download set from:" . $cardAsset->getUrl();

            if ($cardAsset->getExtension() === "png") {
                file_put_contents("storage/tmp.png", file_get_contents($cardAsset->getUrl()));

                if (extension_loaded('imagick')) {
                    $imagick = new Imagick();
                    try {
                        $imagick->readImage('storage/tmp.png');
                        $imagick->writeImages($cardAsset->getAltUrl(), false);
                    } catch (ImagickException $e) {
                        throw new RuntimeException('Error while Imagick-Conversion:'
                            . $cardAsset->getAltUrl() . ', check if exists:' . file_exists($cardAsset->getAltUrl()
                                . "; remote source:" . $cardAsset->getUrl() . ";"));
                    }
                    $result = 1;
                } else {
                    $img = imagecreatefrompng("storage/tmp.png");
                    $result = imagejpeg($img, $cardAsset->getAltUrl());

                    if (!$result) {
                        throw new RuntimeException('Source not found, local source:'
                            . $cardAsset->getAltUrl() . ', check if exists:' . file_exists($cardAsset->getAltUrl()
                                . "; remote source:" . $cardAsset->getUrl() . ";"));
                    }
                }
            } else {
                file_put_contents($cardAsset->getAltUrl(), file_get_contents($cardAsset->getUrl()));
                $result = 1;
            }

            echo($result ? "...download successful" : "...download failed");
            die();
        }
    }

    public function removeAllSetSourcesAction(): void {
        array_map('unlink', glob("storage/*.png"));
        array_map('unlink', glob("storage/*.jpeg"));
        array_map('unlink', glob("storage/*.jpg"));

        echo " All CardSets removed";
    }

    public function removeAllLocalCardImagesAction(): void {
        $cardRepository = new CardRepository();
        $cardService = new CardService();
        $cardService->removeCards($cardRepository->getAssets());

        echo " All Card Images removed";
    }

    public function myGameAction(): void {
        $this->view->assign('set', "TEST");
        $this->view->assign('set', "TEST");
    }

    public function storyCardsAction(): void {
        $cardRepository = new CardRepository();
        $this->view->assign('size', "2");
        $this->view->assign('name', "StoryCard");
        $this->view->assign('cards', $cardRepository->getStoryCardArray());
    }
}
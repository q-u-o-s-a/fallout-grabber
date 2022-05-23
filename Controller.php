<?php /** @noinspection PhpUnused */


namespace FalloutGrabber;

use Imagick;
use ImagickException;
use RuntimeException;

class Controller
{
    private View $view;
    private object $attributes;

    /**
     * Controller constructor.
     * @param View $view
     */
    public function __construct(View $view) {
        $this->view = $view;
        $this->attributes = $this->getAttributes();
        $action = $this->attributes->action . "Action";
        if ($action === 'Action') {
            $action = 'initAction';
        }
        $this->$action();
    }

    public function getAttributes(): object {
        $request = $_GET;
        if (isset($_POST['set'])) {
            $cardNr = (int)($_POST['cardNr'] ?? null);
            $action = (string)($POST['action'] ?? "");
            $set = (string)($POST['set'] ?? "");
        } else {
            $cardNr = (int)($request['cardNr'] ?? null);
            $action = (string)($request['action'] ?? "");
            $set = (string)($request['set'] ?? "");
        }
        return (object)['cardNr' => $cardNr, 'action' => $action, 'set' => $set];
    }

    public function loadCardAction(): void {
        if (isset($this->attributes->set)) {
            $cardRepository = new CardRepository();
            $assets = $cardRepository->getAssets();

            $cardAsset = new CardAsset(
                $assets[$cardRepository->getAssetNrByAssetName($this->attributes->set)],
                $cardRepository->getUrlPrefix()
            );

            $cardService = new CardService();
            $cardService->getCard($this->attributes->cardNr, $cardAsset,
                $assets[$cardRepository->getAssetNrByAssetName($this->attributes->set)][4]);
            echo 'OK';
        }
    }

    public function initAction(): void {
        $this->view->header();
        $this->view->navBar();
        $this->view->content($this->view->showHello());
        $this->view->footer();
    }

    public function overviewAction(): void {
        $cardRepository = new CardRepository();
        $this->view->content($this->view->overviewLeftNavigation(
            $cardRepository->getCardTypes(),
            "",
            $this->view->introCardSet()));
    }

    public function showCardSetAction(): void {
        if (isset($this->attributes->set)) {
            $cardRepository = new CardRepository();
            $this->view->content($this->view->overviewLeftNavigation(
                $cardRepository->getCardTypes(),
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

    public function removeAllSetsAction(): void {
        array_map('unlink', glob("storage/*.png"));
        array_map('unlink', glob("storage/*.jpeg"));

        echo " All CardSets removed";
    }

    public function myGameAction(): void {
        $this->view->content($this->view->showCard("Test", "test", "test",
            null, null, 1));
    }

    public function storyCardsAction(): void {
        $cardRepository = new CardRepository();
        $this->view->content($this->view->showStoryCards($cardRepository->getStoryCardArray()));
    }

    public function showHalloAction(): void {
        $this->view->content($this->view->showHello());
    }

    public function settingsAction(): void {
        $this->view->content($this->view->showSettings());
    }
}
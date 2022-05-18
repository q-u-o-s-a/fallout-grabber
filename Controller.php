<?php /** @noinspection PhpUnused */


namespace FalloutGrabber;

use RuntimeException;

class Controller
{
    private View $view;
    private object $attributes;

    /**
     * Controller constructor.
     * @param \FalloutGrabber\View $view
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

            $cardAsset = new CardAsset($assets[$cardRepository->getAssetNrByAssetName($this->attributes->set)]);

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
            $cardAsset = new CardAsset($cardRepository->getAsset($this->attributes->set));

            if (is_file($cardAsset->getAltUrl())) {
                echo "Set already downloaded";
                die();
            }

            echo "try to download set from:" . $cardAsset->getUrl();
            if ($cardAsset->getExtension() === "png") {
                file_put_contents("storage/tmp.png", file_get_contents($cardAsset->getUrl()));
                $img = imagecreatefrompng("storage/tmp.png");
                $result = imagejpeg($img, $cardAsset->getAltUrl());
                if (!$result) {
                    throw new RuntimeException('Source not found, local source:'
                        . $cardAsset->getAltUrl() . ', check if exists:' . file_exists($cardAsset->getAltUrl()
                            . "; remote source:" . $cardAsset->getUrl() . ";"));
                }
            } else {
                file_put_contents($cardAsset->getAltUrl(), file_get_contents($cardAsset->getUrl()));
                $result = 1;
            }

            echo "Result:" . $result;
            die();
        }
    }

    public function addAction(): void {
        $this->view->content($this->view->showPlus());
    }

    public function showHalloAction(): void {
        $this->view->content($this->view->showHello());
    }
}
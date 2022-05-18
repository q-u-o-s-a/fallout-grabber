<?php /** @noinspection PhpUnused */


namespace FalloutGrabber;


class Controller
{
    private $view;
    private $attributes;

    /**
     * Controller constructor.
     * @param \FalloutGrabber\View $view
     */
    public function __construct(View $view) {
        $this->view = $view;
        $this->attributes = $this->getAttributes();
        $action = $this->attributes->action . "Action";
        if ($action == 'Action') {
            $action = 'initAction';
        }
        $this->$action();
    }

    public function getAttributes() {
        $request = $_GET;
        if (isset($_POST['set'])) {
            $cardNr = (int)$_POST['cardNr'];
            $action = (string)$_POST['action'];
            $set = (string)$_POST['set'];
        } else {
            $cardNr = (int)$request['cardNr'];
            $action = (string)$request['action'];
            $set = (string)$request['set'];
        }
        return (object)['cardNr' => $cardNr, 'action' => $action, 'set' => $set];
    }

    public function loadCardAction() {
        $cardRepository = new CardRepository();
        $assets = $cardRepository->getAssets();

        $cardAsset = new CardAsset($assets[$cardRepository->getAssetNrByAssetName($this->attributes->set)]);

        $cardService = new CardService();
        $cardService->getCard($this->attributes->cardNr, $cardAsset,
            $assets[$cardRepository->getAssetNrByAssetName($this->attributes->set)][4]);
        echo 'OK';
    }

    public function initAction() {
        $this->view->header();
        $this->view->navBar();
        $this->view->content($this->view->showHello());
        $this->view->footer();
    }

    public function overviewAction() {
        $cardRepository = new CardRepository();
        $this->view->content($this->view->overviewLeftNavigation(
            $cardRepository->getCardTypes(),
            "",
            $this->view->introCardSet()));
    }

    public function showCardSetAction() {
        $cardRepository = new CardRepository();
        $this->view->content($this->view->overviewLeftNavigation(
            $cardRepository->getCardTypes(),
            $this->attributes->set,
            $this->view->showCardSet($this->attributes->set, $cardRepository->getAsset($this->attributes->set))));
    }

    public function addAction() {
        $this->view->content($this->view->showPlus());
    }

    public function showHalloAction() {
        $this->view->content($this->view->showHello());
    }
}
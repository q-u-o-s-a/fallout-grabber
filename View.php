<?php

namespace FalloutGrabber;

class View
{
    public function header() {
        echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Fallout Grabber</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="/Resources/Public/Css/bootstrap-icons-1.8.1/bootstrap-icons.css" rel="stylesheet">
                <link href="/Resources/Public/Css/bootstrap.min.css" rel="stylesheet">
                <link href="/Resources/Public/Css/main.css" rel="stylesheet">
                <script src="/Resources/Public/Js/bootstrap.bundle.min.js"></script>
                <script src="/Resources/Public/Js/htmx.js" defer ></script >
            </head>
            <body>';
    }

    public function footer() {
        echo '<div class="mt-5 p-4 bg-dark text-white text-center">
                <p>Developed by J.W., Files from Steam - Fallout - The BoardGame Tabletop Simulator</p>
            </div>
            </body>
            </html>';
    }

    public function navBar() {
        echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#" hx-target="#content" hx-get="/?action=showHallo"><i class="bi-radioactive"
                                                        style="color: orangered;"></i> Fallout Grabber</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" hx-target="#content" hx-get="/?action=myGame">My Game</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" hx-target="#content" hx-get="/?action=overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" hx-target="#content" hx-get="/?action=storyCards">List StoryCards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Save Game</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" hx-target="#content" hx-get="/?action=settings">
                            <i class="bi-gear-wide"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>';
    }

    public function showHello(): string {
        return '<div class="p-lg-5 d-flex align-items-center justify-content-center">
                    <i class="bi-emoji-smile" style = "font-size: 4rem; color: cornflowerblue;" >Hallo!</i >
                </div>';
    }

    public function showSettings(): string {
        return '<div class="p-lg-5 d-flex align-items-center justify-content-center gap-1">
                    <button type="button" hx-get="/?action=removeAllSetSources" class="bi-trash btn btn-primary"> Remove all local CardSet Sources</button></h5>
                    <button type="button" hx-get="/?action=removeAllLocalCardImages" class="bi-trash btn btn-primary"> Remove all local Card Images</button></h5>
                    <button type="button" hx-get="/?action=downloadAllSetSources" class="bi-download btn btn-primary"> Download all local CardSet Sources</button></h5>
                    <button type="button" hx-get="/?action=downloadAllLocalCardImages" class="bi-download btn btn-primary"> Download all local Card Images</button></h5>
                </div>';
    }

    public function content($content) {
        echo '<div id="content" class="container-fluid">
                ' . $content . '
            </div>';
    }

    public function overviewLeftNavigation(array $navItems, string $active, $rightContent): string {
        $content = '<div class="row">
                    <div class="col-sm-2">
                        <h3 class="mt-4">CardTypes</h3>
                        <p>Select CardType, Scenario and Set.</p>
                        <ul class="nav nav-pills flex-column">';
        foreach ($navItems as $navItem) {
            $content .= '     <li class="nav-item">
                                <a hx-get="/?action=showCardSet&set=' . $navItem . '" hx-target="#content" class="nav-link ' . (($navItem == $active) ? "active" : "") . '" href="#">' . $navItem . '</a>
                            </li>';
        }

        $content .= '         <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <hr class="d-sm-none">
                    </div>
                    ' . $rightContent . '
                </div>';
        return $content;
    }

    public function introCardSet(): string {
        return '    <div class="col-sm-10">
                        <h2 class="mt-5">CardSet Overview</h2>
                        <h5>CardSet overview over different CardTypes.</h5>
                        <p>Select CardType</p>
                    </div>';
    }

    public function showCardSet($set, $cards): string {
        $content = '<div class="col-sm-10">
                        <h2 class="mt-5">Cardset</h2>
                        <h5>' . $set . '
                        <button type="button" hx-get="/?action=downloadSet&set=' . $set . '" class="bi-cloud-download btn btn-primary"> </button></h5>
                        <p>Overview over set</p>';

        $content .= '    <div class="row">';

        for ($i = 0; $i < $cards[3]; $i++) {
            $content .= $this->showDetailCard($i, $set, $cards[4],$cards['Names'][$i]);
        }
        $content .= '     </div>
                    </div>';
        return $content;
    }

    public function showCards($cards): string {
        $content = '    <div class="row">';

        foreach ($cards as $card){
            $content .=$this->showDetailCard((int)reset($card), key($card),$card[0]);
        }
        $content .= '     </div>';
        return $content;
    }

    public function showDetailCard(int $cardNr, string $set, $row, $title = null): string {
        $cardRow = floor($cardNr / $row);
        $cardColumn = $cardNr  % $row;

        return $this->showCard($title,
            '/storage/imageCache/' . $set . '/' . $cardRow . '-' . $cardColumn . '.png',
            $set.'-'.$cardNr,
            $this->addButton($set, $cardRow, $cardColumn),
            $this->loadButton($set, $cardNr));
    }

    public function showCard($cardTitle, $imageUrl, $cardName, $addButton = null, $loadButton = null, $size = 3): string {
        return ('         <div class="col-sm-'.$size.' m-1">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">' . $cardTitle . '</h5>
                                <img src="' . $imageUrl . '" class="card-img-top" alt="...">
                                <p class="card-text">' . $cardName . '</p>
                                ' . $addButton . '
                                ' . $loadButton . '
                                </div>
                            </div>
                        </div>');
    }

    private function loadButton($set, $cardNr): string {
        return '<button type="button" hx-target="closest div" hx-get="/?action=loadCard&set=' . $set . '&cardNr=' . $cardNr . '" class="bi-disc btn btn-primary"> </button>';
    }

    private function addButton($set, $cardRow, $cardColumn): string {
        return '<a target="_blank" href="/storage/imageCache/' . $set . '/' . $cardRow . '-' . $cardColumn . '.png"> Add Card</a>';
    }

}
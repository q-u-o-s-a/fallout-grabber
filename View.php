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
                <link href="/css/bootstrap-icons-1.8.1/bootstrap-icons.css" rel="stylesheet">
                <link href="/css/bootstrap.min.css" rel="stylesheet">
                <link href="/css/main.css" rel="stylesheet">
                <script src="/js/bootstrap.bundle.min.js"></script>
                <script src="/js/htmx.js" defer ></script >
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
                            <a class="nav-link active" href="#" hx-target="#content" hx-get="/?action=add">Storycards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#" hx-target="#content" hx-get="/?action=overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Save Game</a>
                        </li>
                    </ul>
                </div>
            </nav>';
    }

    public function showPlus(): string {
        return ' <i hx-get = "/?action=showCard" class="bi-plus-square-dotted" style = "font-size: 4rem; color: cornflowerblue;" ></i > ';
    }

    public function showHello(): string {
        return '<div class="p-lg-5 d-flex align-items-center justify-content-center">
                    <i class="bi-emoji-smile" style = "font-size: 4rem; color: cornflowerblue;" >Hallo!</i >
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
                        <h3 class="mt-4">Cardtypes</h3>
                        <p>Select Cardtype, Scenario and Set.</p>
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
                        <h2 class="mt-5">Cardset Overview</h2>
                        <h5>Cardset overview over different Cardtypes.</h5>
                        <p>Select Cardtype</p>
                    </div>';
    }

    public function showCardSet($set, $cards): string {
        $content = '<div class="col-sm-10">
                        <h2 class="mt-5">Cardset</h2>
                        <h5>' . $set . '</h5>
                        <p>Overview over set</p>';

        $content .= '    <div class="row">';

        for ($i = 0; $i < $cards[3]; $i++) {

            $cardRow = floor($i / $cards[4]);
            $cardColumn = $i % $cards[4];

            $content .= ('         <div class="col-sm-2 m-1">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Card Nr.'.($i+1).'</h5>
                                    <img src="/storage/imageCache/'.$set.'/'.$cardRow.'-'.$cardColumn.'.png" class="card-img-top" alt="...">
                                    <p class="card-text">'.print_r($cards['Names'][$i], true).'</p>
                                    <button type="button" class="bi-plus-square-dotted btn btn-primary"> Add Card</button>
                                    <button type="button" hx-get="/?action=loadCard&set='.$set.'&cardNr='.$i.'" class="bi-cloud-download btn btn-primary"> </button>
                                    </div>
                                </div>
                            </div>');
        }
        $content .= '     </div>
                    </div>';
        return $content;
    }

}
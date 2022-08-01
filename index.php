<?php

//require "View.php";

require "app/Main.php";
require "app/Http/Controllers/AbstractController.php";
require "app/Http/Controllers/DefaultController.php";
require "app/Http/Controllers/PageController.php";
require "app/Domain/CardRepository.php";
require "app/Domain/CardAsset.php";
require "app/Services/CardService.php";

require "vendor/autoload.php";

use FalloutGrabber\Main;

//$view = New View();

//$view = new TemplateView();

//$controller = New Controller($view);

//curl -o output.wav http://localhost:5002/api/tts?text=Hallo.

try {
    Main::init();
} catch (ReflectionException $e) {
    echo print_r($e);
}


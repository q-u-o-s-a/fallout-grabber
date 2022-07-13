<?php
require "app/Domain/CardAsset.php";
require "app/Services/CardService.php";
require "app/Domain/CardRepository.php";
require "View.php";
require "app/Http/Controllers/AbstractController.php";
require "app/Http/Controllers/Controller.php";

require "vendor/autoload.php";

use FalloutGrabber\Controller;
use TYPO3Fluid\Fluid\View\TemplateView;

//$view = New View();

$view = new TemplateView();

$controller = New Controller($view);

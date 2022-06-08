<?php
require "CardAsset.php";
require "CardService.php";
require "CardRepository.php";
require "View.php";
require "AbstractController.php";
require "Controller.php";

require "vendor/autoload.php";

use FalloutGrabber\Controller;
use TYPO3Fluid\Fluid\View\TemplateView;

//$view = New View();

$view = new TemplateView();

$controller = New Controller($view);

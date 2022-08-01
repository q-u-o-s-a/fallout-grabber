<?php

namespace FalloutGrabber;

use ReflectionClass;
use ReflectionException;
use TYPO3Fluid\Fluid\View\TemplateView;

class Main
{
    /**
     * @throws ReflectionException
     */
    public static function init(): void {
        $attributes = self::getAttributes();
        $view = self::getViewInstance($attributes);
        $controller = self::getControllerInstance($view, $attributes);

        echo $controller->init($attributes->controller, $attributes->action);
    }

    private static function getAttributes(): object {
        $request = $_GET;
        if (isset($_POST['action'])) {
            $controller = (string)($POST['controller'] ?? "page");
            $action = (string)($POST['action'] ?? "init");
            $set = (string)($POST['set']);
            $cardNr = (string)($POST['cardNr']);
        } else {
            $controller = (string)($request['controller'] ?? "page");
            $action = (string)($request['action'] ?? "init");
            $set = (string)($request['set']);
            $cardNr = (string)($request['cardNr']);
        }
        return (object)['action' => $action, 'controller' => $controller, 'set' => $set, 'cardNr' => $cardNr];
    }

    private static function getViewInstance($attributes): TemplateView {
        $templateView = new TemplateView();
        $templateView->getTemplatePaths()->fillDefaultsByPackageName('');
        $templateView->getRenderingContext()->setControllerName(ucfirst($attributes->controller));

        return $templateView;
    }

    /**
     * @throws ReflectionException
     */
    private static function getControllerInstance(TemplateView $view, object $attributes): object {
        $controllerClassName = '\\FalloutGrabber\\' . ucfirst($attributes->controller) . 'Controller';
        if (class_exists($controllerClassName)) {
            $reflectionClass = new ReflectionClass($controllerClassName);
        } else {
            $reflectionClass = new ReflectionClass(DefaultController::class);
        }
        $args = [&$view, $attributes];
        return $reflectionClass->newInstanceArgs($args);
    }
}
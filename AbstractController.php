<?php

namespace FalloutGrabber;

use TYPO3Fluid\Fluid\View\TemplateView;

class AbstractController
{
    protected TemplateView $view;
    protected object $attributes;

    /**
     * AbstractController constructor.
     * @param TemplateView $view
     */
    public function __construct(TemplateView $view) {
        $this->view = $view;

        $this->attributes = $this->getAttributes();
        $action = $this->attributes->action . "Action";
        if (method_exists($this, $action)) $this->$action();

        $paths = $this->view->getTemplatePaths();
        $paths->fillDefaultsByPackageName('');
        $this->view->getRenderingContext()->setControllerName(ucfirst($this->attributes->controller));

        echo $this->view->render($this->attributes->action);
    }

    public function getAttributes(): object {
        $request = $_GET;
        if (isset($_POST['set'])) {
            $cardNr = (int)($_POST['cardNr'] ?? null);
            $controller = (string)($POST['controller'] ?? "page");
            $action = (string)($POST['action'] ?? "init");
            $set = (string)($POST['set'] ?? "");
        } else {
            $cardNr = (int)($request['cardNr'] ?? null);
            $controller = (string)($request['controller'] ?? "page");
            $action = (string)($request['action'] ?? "init");
            $set = (string)($request['set'] ?? "");
        }
        return (object)['cardNr' => $cardNr, 'action' => $action, 'set' => $set, 'controller' => $controller];
    }

}
<?php

namespace FalloutGrabber;

use TYPO3Fluid\Fluid\View\TemplateView;

abstract class AbstractController
{
    public const ActionMethodIdent = 'Action';

    protected TemplateView $view;
    protected object $attributes;

    public function __construct(TemplateView $view, $attributes) {
        $class = substr(explode('\\', get_class($this))[1], 0, -10);
        $this->view = $view;
        $this->attributes = $attributes;
        $this->view->getRenderingContext()->setControllerName(ucfirst($class));
    }

    public function init($controller, $action) {
        $actionMethod = $action . $this::ActionMethodIdent;
        if (method_exists($this, $actionMethod)) {
            $this->$actionMethod($this->attributes);
        }

        if ($this->view->getTemplatePaths()->resolveTemplateFileForControllerAndActionAndFormat(ucfirst($controller),
            ucfirst($action))) {

            return $this->view->render($action);
        }
        return $this->view->render();
    }

}
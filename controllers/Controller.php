<?php

namespace app\controllers;

use app\engine\Router;
use app\engine\Request;
use app\engine\TwigRender;
use app\interfaces\IRender;

class Controller
{
    protected $render;
    protected $router;

    public function __construct()
    {
        $this->render = new TwigRender;
        $this->router = new Router();
    }

    public function runAction($action)
    {
        $this->action = $action;
        $method = $this->action;

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die('404 нет такого экшена');
        }
    }

    public function render($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}
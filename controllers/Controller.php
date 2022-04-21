<?php

namespace app\controllers;

use app\engine\Router;
use app\interfaces\IRender;

class Controller
{
    private $render;
    public $router;

    public function __construct(IRender $render)
    {
        $this->render = $render;
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

    public function index()
    {
        echo $this->render('index', []);
    }
}
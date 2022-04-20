<?php

namespace app\controllers;

use app\interfaces\IRender;

class Controller
{
    private $render;

    public function __construct(IRender $render)
    {
        $this->render = $render;
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
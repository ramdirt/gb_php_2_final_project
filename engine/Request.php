<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;

    protected $method;
    protected $params = [];


    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __construct()
    {
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $url = explode("/", $_SERVER['REQUEST_URI']);

        $this->controllerName = !empty($url[1]) ? $url[1] : 'public';
        $this->actionName = !empty($url[2]) ? $url[2] : 'index';

        $this->params = $_REQUEST;
    }
}
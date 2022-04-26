<?php

namespace app\engine;

class Session
{
    protected $params;

    public function __construct()
    {
        $this->parseSession();
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function parseSession()
    {
        $this->params = $_SESSION;
    }
}
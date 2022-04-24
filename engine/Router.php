<?php

namespace app\engine;

class Router
{
    public static function redirect($page, $action = 'index')
    {
        header('Location:' . "/{$page}/{$action}");
    }
}
<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $fileName = ROOT . DS . str_replace('\\', DS, $className) . '.php';
        $fileName = str_replace(DS . 'app' . DS, DS, $fileName);

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}
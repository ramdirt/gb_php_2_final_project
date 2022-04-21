<?php
session_start();
var_dump($_SESSION);

use app\engine\Autoload;
use app\engine\TwigRender;


//TODO добавьте абсолютные пути
include dirname(__DIR__) .  "/engine/Autoload.php";
include dirname(__DIR__) . "/config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);


$controllerName = $_GET ? $_GET['c'] : '';
$actionName = $_GET ? $_GET['a'] : 'index';

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender);
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}
<?php
session_start();

use app\engine\Autoload;
use app\engine\TwigRender;

$url = explode("/", $_SERVER['REQUEST_URI']);
var_dump($url);

include dirname(__DIR__) .  "/engine/Autoload.php";
include dirname(__DIR__) . "/config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);
require_once '../vendor/autoload.php';

$controllerName = !empty($url[1]) ? $url[1] : 'public';
$actionName = !empty($url[2]) ? $url[2] : 'index';

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}
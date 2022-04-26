<?php
session_start();

use app\engine\Request;
use app\engine\Autoload;

include dirname(__DIR__) .  "/engine/Autoload.php";
include dirname(__DIR__) . "/config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);
require_once '../vendor/autoload.php';

$request = new Request();

$controllerName = $request->controllerName ?: 'public';
$actionName = $request->actionName ?: 'index';

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}
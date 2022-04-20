<?php
session_start();

use app\models\Basket;
use app\engine\Autoload;
use app\models\{Product, User};


//TODO добавьте абсолютные пути
include dirname(__DIR__) .  "/engine/Autoload.php";
include dirname(__DIR__) . "/config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product("Пицца", 1, '1.jpg', 125, "Описание");
// $product->save();


$product_two = Product::getOne(106);
// $product_two->title = "Покрышка 1";
// $product_two->img = '1.jpg';
// $product_two->update();

// $product_two->price = $product_two->price + 100;
// $product_two->save();




$controllerName = $_GET ? $_GET['c'] : '';
$actionName = $_GET ? $_GET['a'] : 'index';

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";


if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}
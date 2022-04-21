<?php

namespace app\controllers;

use app\models\Basket;
use app\engine\Router;

class BasketController extends Controller
{
    public function index()
    {
        $basket = Basket::getBasket();

        echo $this->render('basket/index', [
            'basket' => $basket
        ]);
    }

    public function insert()
    {
        $id = $_GET['id'];
        $session = session_id();

        $product = Basket::isProductInBasket($id);

        if (empty($product)) {
            $product = new Basket(null, $session, $id, 1);
            echo "Товар добавлен";
        } else {
            $product->quantity = (int)$product->quantity + 1;
            echo "Увеличено количетсво товара для {$product->id}";
            Router::redirect('basket');
        }
        $product->save();
    }
}
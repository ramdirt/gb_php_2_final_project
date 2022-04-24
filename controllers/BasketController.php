<?php

namespace app\controllers;

use app\models\Basket;

class BasketController extends Controller
{
    public function index()
    {
        $basket = Basket::getBasket();

        echo $this->render('basket/index', [
            'basket' => $basket
        ]);
    }

    public function add()
    {
        $id = $_POST['id'];

        $session = session_id();

        $product = Basket::isProductInBasket($id);

        if (empty($product)) {
            $product = new Basket(null, $session, $id, 1);
        } else {
            $product->quantity = (int)$product->quantity + 1;
        }
        $product->save();

        $count = Basket::getCountItemBasket();

        echo json_encode([
            'status' => true,
            'countItemBasket' => $count
        ]);
    }




    public function delete()
    {

        $id = (int) $_POST['id'];

        $product = Basket::getOne($id);

        if ($product->quantity > 1) {
            $product->quantity -= 1;
            $product->save();
            $action = 'quantity';
        } else {
            $product->delete();
            $action = 'delete';
        }

        $count = Basket::getCountItemBasket();

        echo json_encode([
            'status' => true,
            'countItemBasket' => $count,
            'action' => $action,
        ]);
    }
}
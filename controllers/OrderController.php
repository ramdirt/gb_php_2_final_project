<?php

namespace app\controllers;

use app\models\User;
use app\models\Order;
use app\models\Basket;
use app\engine\Request;
use app\models\OrderDetails;

class OrderController extends Controller
{
    public function add()
    {
        $name = (new Request())->params['name'];
        $phone = (new Request())->params['phone'];
        $basket = Basket::getBasket();
        $user_id = (int) User::getWhere('login', $_SESSION['user']['login'])->id ?? null;

        $order = new Order($user_id, $name, $phone);

        $order->save();

        foreach ($basket as $item) {
            $order_id = $order->id;
            $product_id = (int) $item['product_id'];
            $product_name = $item['title'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            $order_details = new OrderDetails($order_id, $product_id, $product_name, $price, $quantity);

            $order_details->save();
        }

        Basket::deleteBasket($basket);
        echo "Ваш заказ №{$order->id} создан<br>";
        echo "<a href='/'>На главную</a>";
    }

    public function show()
    {
        // TODO Сделать состава заказа на страницу
    }
}
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
        $session_id = session_id();
        $user_id = isset($_SESSION['user']) ? User::getWhere('login', $_SESSION['user']['login'])->id : null;

        $order = new Order($user_id, $name, $phone, $session_id, 1);

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

    public static function update_status()
    {
        User::isAdmin();

        $order_id = (new Request())->params['order_id'];
        $status_id = (new Request())->params['status_id'];

        $order = Order::getOne($order_id);
        $order->status_id = $status_id;
        $order->update();

        echo json_encode([
            'status' => true,
            'status_id' => $order->status_id
        ]);
    }
}
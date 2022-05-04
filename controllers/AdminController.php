<?php

namespace app\controllers;

use app\engine\Db;
use app\models\User;
use app\models\Order;
use app\engine\Request;
use app\models\OrderDetails;

class AdminController extends Controller
{
    public function index()
    {
        User::isAdmin();

        $orders = Order::getAll();

        echo $this->render('admin/index', [
            'orders' => $orders,
        ]);
    }

    public function show_order()
    {
        User::isAdmin();

        $order_id = (int) ((new Request()))->params['id'];
        $order = OrderDetails::getOrderDetails($order_id);

        $sql = "SELECT * FROM `status`";
        $all_status = Db::getInstance()->queryAll($sql);

        echo $this->render('admin/show_order', [
            'order_id' => $order_id,
            'order' => $order['products'],
            'status_order' => $order['status'],
            'price' => $order['price'],
            'all_status' => $all_status
        ]);
    }
}
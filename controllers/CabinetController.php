<?php

namespace app\controllers;

use app\models\User;
use app\models\Order;
use app\controllers\Controller;

class CabinetController extends Controller
{
    public function index()
    {
        echo $this->render('cabinet/index', [
            'user' => User::getWhere('login', $_SESSION['user']['login']),
            'orders' => Order::getOrders()
        ]);
    }
}

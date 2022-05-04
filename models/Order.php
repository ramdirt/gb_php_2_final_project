<?php

namespace app\models;

use app\engine\Db;
use app\engine\Request;

class Order extends DBModel
{
    protected $id;
    protected $user_id;
    protected $name;
    protected $phone;
    protected $session_id;
    protected $status_id;

    protected $props = [
        'user_id' => false,
        'name' => false,
        'phone' => false,
        'session_id' => false,
        'status_id' => false
    ];

    public function __construct($user_id = null, $name = null, $phone = null, $session_id = null, $status_id = null)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->phone = $phone;
        $this->session_id = $session_id;
        $this->status_id = $status_id;
    }

    public static function getTableName()
    {
        return 'orders';
    }

    public static function getOrders()
    {
        $user_id = User::getWhere('login', $_SESSION['user']['login'])->id;
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE user_id = :user_id";
        $orders = Db::getInstance()->queryAll($sql, ['user_id' => $user_id]);
        return $orders;
    }
}
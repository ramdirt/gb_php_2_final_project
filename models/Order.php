<?php

namespace app\models;

use app\engine\Db;

class Order extends DBModel
{
    protected $id;
    protected $user_id;
    protected $name;
    protected $phone;
    protected $status_id;

    protected $props = [
        'user_id' => false,
        'name' => false,
        'phone' => false,
        'status_id' => false
    ];

    public function __construct($user_id = null, $name = null, $phone = null, $status_id = null)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->phone = $phone;
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
        var_dump($orders);
        return $orders;
    }
}

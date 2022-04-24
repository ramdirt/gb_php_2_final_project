<?php

namespace app\models;

use app\engine\Db;
use app\models\Product;

class Basket extends DBModel
{
    protected $id;
    protected $user_id;
    protected $session_id;
    protected $product_id;
    protected $quantity;

    protected $props = [
        'user_id' => false,
        'session_id' => false,
        'product_id' => false,
        'quantity' => false
    ];

    public function __construct($user_id = null, $session_id = null, $product_id = null, $quantity = null)
    {
        $this->user_id = $user_id;
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }


    public static function getBasket()
    {
        $session_id = session_id();
        $tableName = static::getTableName();
        $sql = "SELECT basket.id as basket_id, products.id as product_id, products.title, products.img, products.description, products.price, basket.quantity FROM {$tableName}, `products` WHERE session_id = :session_id AND basket.product_id = products.id";
        $basket = Db::getInstance()->queryAll($sql, ['session_id' => $session_id]);

        return $basket;
    }

    public static function getCountItemBasket()
    {
        $session_id = session_id();
        $tableName = static::getTableName();
        $sql = "SELECT SUM(quantity) FROM {$tableName} WHERE session_id = :session_id";
        $count = Db::getInstance()->queryOne($sql, ['session_id' => $session_id])['SUM(quantity)'];
        return (int) $count;
    }


    public static function isProductInBasket($id)
    {
        $session_id = session_id();
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE session_id = :session_id AND product_id = :product_id";
        $basket = Db::getInstance()->queryOneObject($sql, [
            'session_id' => $session_id,
            'product_id' => $id
        ], static::class);

        return $basket;
    }

    public static function deleteItemBasket($id)
    {
    }

    public static function getTableName()
    {
        return 'basket';
    }
}
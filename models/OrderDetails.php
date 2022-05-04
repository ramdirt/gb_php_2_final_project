<?php

namespace app\models;

use app\engine\Db;

class OrderDetails extends DBModel
{
    protected $id;
    protected $order_id;
    protected $product_id;
    protected $product_name;
    protected $price;
    protected $quantity;

    protected $props = [
        'order_id' => false,
        'product_id' => false,
        'product_name' => false,
        'price' => false,
        'quantity' => false
    ];

    public function __construct($order_id = null, $product_id = null, $product_name = null, $price = null, $quantity = null)
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public static function getTableName()
    {
        return 'orders_details';
    }

    public static function getOrderDetails($order_id)
    {
        $products = OrderDetails::getWhereAll('order_id', $order_id);
        $status_id = (int) Order::getOne($order_id)->status_id;


        $sql = "SELECT * FROM `status` WHERE id = :id";
        $status = Db::getInstance()->queryOne($sql, ['id' => $status_id])['name'];

        $price_sum = 0;
        foreach ($products as $item) {
            $price_sum += $item['price'] * $item['quantity'];
        }

        return [
            'status' => $status,
            'products' => $products,
            'price' => $price_sum
        ];
    }
}
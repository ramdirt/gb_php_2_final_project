<?php

namespace app\models;

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
}
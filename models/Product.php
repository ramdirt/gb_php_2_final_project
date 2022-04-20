<?php

namespace app\models;


class Product extends DBModel
{
    protected $id;
    protected $title;
    protected $category_id;
    protected $img;
    protected $price;
    protected $description;


    protected $props = [
        'title' => false,
        'category_id' => false,
        'img' => false,
        'price' => false,
        'description' => false
    ];


    public function __construct($title = null, $category_id = null, $img = null, $price = null, $description = null)
    {
        $this->title = $title;
        $this->category_id = $category_id;
        $this->img = $img;
        $this->price = $price;
        $this->description = $description;
    }


    protected static function getTableName()
    {
        return 'products';
    }
}
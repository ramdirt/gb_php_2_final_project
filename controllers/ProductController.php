<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $id = (int) $_GET['id'];
        $product = Product::getOne($id);

        echo $this->render('product/index', [
            'product' => $product
        ]);
    }
}
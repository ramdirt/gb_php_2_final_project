<?php

namespace app\controllers;

use app\models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $page = $_GET['page'] ?? 0;

        $catalog = Product::getAll();
        // $catalog = Product::getLimit(($page + 1) * 2);
        echo $this->render('catalog/index', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }
}
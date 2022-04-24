<?php

namespace app\controllers;

class PublicController extends Controller
{
    public function index()
    {
        echo $this->render('index', []);
    }
}
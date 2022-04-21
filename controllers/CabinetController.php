<?php

namespace app\controllers;

class CabinetController extends Controller
{
    public function index()
    {
        echo $this->render('cabinet/index');
    }
}
<?php

namespace app\controllers;

use app\models\User;
use app\engine\Router;

class AuthController extends Controller
{

    public function index()
    {
        echo $this->render('auth/login');
    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $error = array();

        if (empty($login)) {
            $error[] = 'login';
        }
        if (empty($password)) {
            $error[] = 'password';
        }
        if (!empty($error)) {
            die('Вы не заполнили все поля');
        }

        $user = User::getUser($login, $password);

        $_SESSION['user'] = [
            "id" => $user->id,
            "name" => $user->name,
            "login" => $user->login,
            "email" => $user->email,
        ];

        $this->router->redirect('');
    }

    public function signup()
    {
        echo $this->render('auth/signup');
    }

    public function save()
    {
        echo $_POST;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->router->redirect('');
    }
}
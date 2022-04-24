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

        $auth = User::isAuth($login, $password);

        if ($auth) {
            $_SESSION['user'] = [
                "login" => $login,
            ];
            $this->router->redirect('public');
        } else {
            $this->router->redirect('auth');
            die();
        }
    }

    public function signup()
    {
        // TODO Реализовать страницу регистрации
        echo $this->render('auth/signup');
    }

    public function save()
    {
        // TODO Реализовать метод сохранения пользователя
        // после регистрации 
        echo $_POST;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->router->redirect('public');
    }
}
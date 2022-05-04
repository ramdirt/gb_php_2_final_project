<?php

namespace app\controllers;

use app\models\User;
use app\engine\Request;

class AuthController extends Controller
{

    public function index()
    {
        if (isset($_COOKIE['hash'])) {
            $user = User::authForCookie();

            if ($user) {
                $_SESSION['user'] = [
                    "login" => $user->login,
                ];
                $this->router->redirect('public');
            }
        } else {;
            echo $this->render('auth/login');
        }
    }

    public function login()
    {
        $login = (new Request())->params['login'];
        $password = (new Request())->params['password'];
        $saveCookie = (new Request())->params['save'];

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

        if (!empty($saveCookie)) {
            User::createHashAndCookiesForUser($login);
        }



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
        session_regenerate_id();
        session_destroy();
        $this->router->redirect('public');
    }
}
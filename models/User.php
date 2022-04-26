<?php

namespace app\models;

use app\engine\Db;


class User extends DBModel
{
    public $id;
    public $name;
    public $login;
    public $email;
    public $password;

    protected $props = [
        'name' => false,
        'login' => false,
        'email' => false,
        'password' => false
    ];



    public function __construct($name = null, $login = null, $email = null, $password = null)
    {

        $this->name = $name;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }


    protected static function getTableName()
    {
        return 'users';
    }

    public static function isAuth($login, $password)
    {
        $tableName = static::getTableName();
        $password = md5($password);

        $sql = "SELECT * FROM {$tableName} WHERE login = :login AND password = :password";
        $isAuth = Db::getInstance()->queryOne($sql, [
            'login' => $login,
            'password' => $password
        ]);

        return $isAuth ? true : false;
    }
    public static function createHashAndCookiesForUser($login)
    {
        $tableName = static::getTableName();
        $hash = uniqid(rand(), true);
        $sql = "UPDATE {$tableName} SET hash = :hash WHERE login = :login";
        Db::getInstance()->queryOne($sql, [
            'login' => $login,
            'hash' => $hash
        ]);
        setcookie("hash", $hash, time() + 20);
    }

    public static function authForCookie()
    {
        $hash = $_COOKIE['hash'];
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE hash = :hash";
        $isAuth = Db::getInstance()->queryOneObject($sql, [
            'hash' => $hash
        ], static::class);

        return $isAuth ? $isAuth : setcookie("hash");
    }
}
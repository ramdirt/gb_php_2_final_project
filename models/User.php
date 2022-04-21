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

    public static function getUser($login, $password)
    {
        $tableName = static::getTableName();
        $password = md5($password);

        $sql = "SELECT * FROM {$tableName} WHERE login = :login AND password = :password";
        $user = Db::getInstance()->queryOneObject($sql, ['login' => $login, 'password' => $password], static::class);

        return $user;
    }
}
<?php

namespace app\models;


class User extends Model
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


    protected function getTableName()
    {
        return 'users';
    }
}
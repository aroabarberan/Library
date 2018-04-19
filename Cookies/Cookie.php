<?php

class Cookie
{
    public $name;
    public $value;
    public $exdays;
    public $userLogin = 'user';

    public function __construct($name, $value, $exdays = 1)
    {
        $this->name = $name;
        $this->value = $value;
        $this->exdays = $exdays;
        setcookie($this->name, $this->value, $this->exdays);
    }
    public static function create($value)
    {
        setcookie($this->userLogin, $value, time() + 3600);
    }

    public static function delete()
    {
        setcookie($this->userLogin, "", time() - 3600);
    }

    public static function islogin($users, $userName, $password)
    {
        for ($i = 0; $i < count($users); $i++) {
            if ($userName == $users[$i]['Usuario'] && $password == $users[$i]['Clave']) {
                return true;
            }
        }
        return false;
    }

    public static function isExists($userName)
    {
//    if (!isset($_COOKIE[$userName])) {
        //        echo "Cookie named '" . $userName . "' is not set!";
        //    } else {
        //        echo "Cookie '" . $userName . "' is set!<br>";
        //    }
        return isset($_COOKIE[$userName]);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getExdays()
    {
        return $this->exdays;
    }

    public function setExdays($exdays)
    {
        $this->exdays = $exdays;
    }
}

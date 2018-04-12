<?php

class Cookie
{
    public $name;
    public $value;
    public $exdays;


    public function __construct($name, $value, $exdays = 1)
    {
        $this->name = $name;
        $this->value = $value;
        $this->exdaya = $exdays;
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

    public function getExdaya()
    {
        return $this->exdaya;
    }

    public function setExdaya($exdaya)
    {
        $this->exdaya = $exdaya;
    }

    public function getExdays()
    {
        return $this->exdays;
    }
    public function setExdays($exdays)
    {
        $this->exdays = $exdays;
    }

    public function delete ($name) {
        setcookie($name, "", time() - 3600);
    }
}
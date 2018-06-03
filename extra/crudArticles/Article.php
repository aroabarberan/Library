<?php

class Article
{

    private $id;
    private $nombre;
    private $marca;
    private $modelo;
    private $precio;
    private $familia;
    private $imagen;
    private $tipo;


    public function __get($property)
    {
        return $this->$property;
    }

    public function setProperty($property, $value)
    {
        $this->$property = $value;
    }

}

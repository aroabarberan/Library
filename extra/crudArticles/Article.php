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

    public function __construct($id = '', $nombre = '', $marca = '', $modelo = '', $precio = '', $familia = '', $imagen = '', $tipo = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
        $this->familia = $familia;
        $this->imagen = $imagen;
        $this->tipo = $tipo;
    }

    public function getProperty($property)
    {
        return $this->$property;
    }

    public function setProperty($property, $value)
    {
        $this->$property = $value;
    }

}

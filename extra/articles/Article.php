<?php


class Article
{
    private $Id;
    private $Nombre;
    private $Marca;
    private $Modelo;
    private $Precio;
    private $Familia;
    private $Imagen;
    private $Tipo;

    public function __get($k)
    {
        return $this->$k;
    }

    public function __set($k, $v)
    {
        $this->$k = $v;
    }

}
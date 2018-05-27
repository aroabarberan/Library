<?php

require_once("Article.php");
require_once("classConexion.php");

class DaoArticulo
{

    private $con;

    public $resul = array();

    public function __CONSTRUCT($base)
    {
        try {
            $this->con = new DB($base);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $consulta = "select * from articulos";
            $param = array();

            $this->con->Consulta($consulta, $param);
            $this->resul = array();


            foreach ($this->con->datos as $fila) {
                $article = new Article();

                $article->__set("Id", $fila['Id']);
                $article->__set("Marca", $fila['Marca']);
                $article->__set("Modelo", $fila['Modelo']);
                $article->__set("Precio", $fila['Precio']);
                $article->__set("Familia", $fila['Familia']);
                $article->__set("Imagen", $fila['Imagen']);
                $article->__set("Tipo", $fila['Tipo']);

                $this->resul[] = $article;
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    public function return($id)
    {
        try {
            $consulta = "select * from articulos WHERE Id=:Id";
            $param = array("Id" => $id);

            $this->con->Consulta($consulta, $param);

            if (empty($this->con->datos)) {
                return null;

            }
            $row = $this->con->datos[0];
            $article = new Article();

            $article->__set("Id", $row['Id']);
            $article->__set("Marca", $row['Marca']);
            $article->__set("Modelo", $row['Modelo']);
            $article->__set("Precio", $row['Precio']);
            $article->__set("Familia", $row['Familia']);
            $article->__set("Imagen", $row['Imagen']);
            $article->__set("Tipo", $row['Tipo']);
            return $article;

        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }
}
 
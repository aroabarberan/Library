<?php


class DB
{

    private $con;
    private $bbdd;
    private $host = "localhost";
    private $usu = "root";
    private $clave = "";
    public $datos;


    public function __construct($base)
    {
        try {
            $this->bbdd = $base;
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->bbdd", $this->usu, $this->clave);
            $this->con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->con->exec("set names utf8mb4");
        } catch (PDOException $e) {
            echo "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
            echo "  <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }


    public function ConsultaSimple($consulta, $param)
    {
        $sta = $this->con->prepare($consulta);
        if (!$sta->execute($param)) {
            echo " <p>Eror en la consulta<p>\n";
        }

    }

    public function Consulta($consulta, $param)
    {

        $sta = $this->con->prepare($consulta);
        $this->datos = array();

        if ($sta->execute($param)) {
            while ($fila = $sta->fetch()) {
                $this->datos[] = $fila;
            }
        } else {
            echo "  <p>Eror en la consulta<p>\n";
        }
    }

    public function Cerrar()
    {
        $this->con = null;
    }

    public function __destruct()
    {
        $this->Cerrar();
    }
}

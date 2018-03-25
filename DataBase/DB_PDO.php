<?php
// ini_set(‘display_errors’, ‘On’);
// error_reporting(E_ALL);

require_once 'DB.php';
require_once '../Files/File.php';

class DB_PDO implements DB
{
    private $link;
    private $data;

    public function __construct()
    {
        $this->data = File::readFileEnv('.env');
        return $this->connect();
    }

    private function connect()
    {
        try {
            $this->link = new PDO("mysql:host=" .
                $this->data['DB_HOST'] . ";dbname=" .
                $this->data['DB_DATABASE'],
                $this->data['DB_USERNAME'],
                $this->data['DB_PASSWORD']);

            $this->link->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->link->exec("set names utf8mb4");
            //return($this->conexion);
        } catch (PDOException $e) {
            echo "    <p>Error: Cannot connect to database.</p>\n";
            echo "    <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }

    public function readAll()
    {

    }
    public function Consulta($consulta, $param)
    {

        $sta = $this->con->prepare($consulta);

        if ($sta->execute($param)) {
            while ($fila = $sta->fetch()) {
                $this->datos[] = $fila;
            }
        } else {
            echo "Error " . PDO::errorInfo();
        }

    }

}

$bla = new DB_PDO();
echo "<pre>" . print_r($bla, true) . "</pre>";

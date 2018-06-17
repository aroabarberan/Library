<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include(dirname(__FILE__) . '/DB.php'); 
include(dirname(__FILE__) . '/../Files/File.php'); 

class DataBasePDO implements DB
{
    private $link;
    public $table;

    public function __construct()
    {
        $this->data = File::readFileEnv(dirname(__FILE__) . '/.env');
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
        } catch (PDOException $e) {
            echo "    <p>Error: Cannot connect to database.</p>\n";
            echo "    <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }

    public function insert($stringFields, $arrayParams)
    {
        $params = array_flip($arrayParams);
        $query = "INSERT INTO $this->table ($stringFields) VALUES (";

        for ($i = 0; $i < count($arrayParams); $i++) {
            if ($i == count($arrayParams) - 1) {
                $query .= ":" . $arrayParams[$i];
            } else {
                $query .= ":" . $arrayParams[$i] . ", ";
            }
            $params[$arrayParams[$i]] = $arrayParams[$i];
        }
        $query .= ")";
        $this->query($query, $params);
    }

    public function read($idTable, $value)
    {
        return $this->query("SELECT * FROM $this->table WHERE $idTable='$value'");
    }

    public function readAll()
    {
        return $this->query("SELECT * FROM $this->table");
    }

    public function update($arrayFiels, $arrayParams)
    {
        $query = "UPDATE $this->table SET ";
        $params = array_flip($arrayParams);

        for ($i = 0; $i < count($arrayParams); $i++) {
            if ($i == count($arrayParams) - 1) {
                $query .= $arrayFiels[$i] . " = :" . $arrayParams[$i];
            } else {
                $query .= $arrayFiels[$i] . " = :" . $arrayParams[$i] . ", ";
            }
            $params[$arrayParams[$i]] = $arrayParams[$i];
        }
        $query .= " WHERE $arrayFiels[0]='$arrayParams[0]'";
        $this->query($query, $params);
    }

    public function remove($idTable, $value)
    {
        $query = "DELETE FROM $this->table WHERE $idTable=:" . $idTable;
        $params = [":$idTable" => $value];

        return $this->query($query, $params);
    }

    public function query($query, $params = [])
    {
        $data = [];
        $result = $this->link->prepare($query);
        $success = $result->execute($params);
        if (!$success) {
            echo "<br>Error Query -> " . $result->errorInfo();
            echo "<pre>" .print_r($result->errorInfo(), true);
            return false;
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }  
        return $data;
    }
    public function setTable($table)
    {
        $this->table = $table;
    }
}

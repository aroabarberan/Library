<?php
ini_set(‘display_errors’, ‘On’);
error_reporting(E_ALL);

require_once 'DB.php';
require_once '../Files/File.php';

class DataBasePDO implements DB
{
    private $link;
    public $data;

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
        } catch (PDOException $e) {
            echo "    <p>Error: Cannot connect to database.</p>\n";
            echo "    <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }

    public function readAll($table)
    {
        return $this->link->query("SELECT * FROM $table");
    }

    public function query($query, $params = [])
    {
        $row = [];
        $statement = $this->link->prepare($query);
        if ($statement->execute($params)) {
            while ($row = $statement->fetch()) {
                $this->data[] = $row;
            }
        } else {
            echo "Error ";
        }        
    }
}

$bla = new DataBasePDO();
$bla->readAll("coches");

echo "<pre>" . print_r($bla->readAll("coches"), true) . "</pre>";
echo "<pre>" . print_r($this->data, true) . "</pre>";

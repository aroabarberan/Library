<?php

class Database
{
    private static $instance;
    private $pdo;

    private function __construct()
    {
        
        $configuration = Database::configuration();
        $this->pdo = new PDO('mysql:host=' . $configuration['host'] . ';dbname=' . $configuration['database'] . '', $configuration['username'], $configuration['password']);
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $this->pdo->exec("set names utf8mb4");
        
    }

    private static function configuration()
    {
        $file = fopen('dbconf.json', 'r');
        $content = '';
        while (!feof($file)) {
            $content .= fgets($file);
        }
        $contentJson = json_decode($content, true);
        return $contentJson;
    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(Database::$instance)) {
            Database::$instance = new Database();
        }
        return Database::$instance;
    }

    /**
     * @param string $consulta
     * @param array $param
     * @return array|boolean
     */
    public function queryExec($consulta, $param = [])
    {
        
        $rows = [];
        $result = $this->pdo->prepare($consulta);
        $success = $result->execute($param);
        if (!$success) {
            print "<p>Error en la consulta.</p>\n";
            return false;
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

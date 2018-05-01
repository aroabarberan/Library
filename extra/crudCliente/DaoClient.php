<?php

require_once 'Client.php';
require_once 'Database.php';

class DaoClient
{
    const TABLE = 'clientes';

    public function __construct()
    {
    }

    /**
     * @param Client $object
     * @return void
     */
    public static function create($object)
    {
        $db = Database::getInstance();
        $query = 'INSERT INTO ' . DaoClient::TABLE . '
        (NIF, Nombre, Apellido1, Apellido2, Imagen, Tipo)
        VALUES (:nif, :nombre, :apellido1, :apellido2, :imagen, :tipo)';

        $params = [
            ":nif" => $object->getNif(),
            ":nombre" => $object->getNombre(),
            ":apellido1" => $object->getApellido1(),
            ":apellido2" => $object->getApellido2(),
            ":imagen" => $object->getImagen(),
            ":tipo" => $object->getTipo(),
        ];
        $db->queryExec($query, $params);
    }

    /**
     * @param $id
     * @return Client
     */
    public static function read($id)
    {
        $db = Database::getInstance();
        $query = 'SELECT * FROM ' . DaoClient::TABLE . ' WHERE NIF=:cod';
        $params = [
            ':cod' => $id,
        ];
        $result = $db->queryExec($query, $params);
        $clie = new Client(
            $result[0]['NIF'],
            $result[0]['Nombre'],
            $result[0]['Apellido1'],
            $result[0]['Apellido2'],
            $result[0]['Imagen'],
            $result[0]['Tipo']
        );
        return $clie;
    }

    /**
     * @return Client []
     */
    public static function readAll()
    {
        $db = Database::getInstance();
        $query = 'SELECT * FROM ' . DaoClient::TABLE;
        $result = $db->queryExec($query);
        $objects = [];
        foreach ($result as $item) {
            $clie = new Client(
                $item['NIF'],
                $item['Nombre'],
                $item['Apellido1'],
                $item['Apellido2'],
                $item['Imagen'],
                $item['Tipo']
            );
            array_push($objects, $clie);
        }
        return $objects;
    }

    /**
     * @param Client $object
     */
    public static function update($object)
    {
        $db = Database::getInstance();
        $query = 'UPDATE ' . DaoClient::TABLE . ' SET
        NIF = :nif, Nombre = :nombre, Apellido1 = :apellido1, Apellido2 = :apellido2,
        Imagen = :imagen, Tipo = :tipo
        WHERE NIF = :nif';

        $params = [
            ":nif" => $object->getNif(),
            ":nombre" => $object->getNombre(),
            ":apellido1" => $object->getApellido1(),
            ":apellido2" => $object->getApellido2(),
            ":imagen" => $object->getImagen(),
            ":tipo" => $object->getTipo(),
        ];
        $db->queryExec($query, $params);
    }

    /**
     * @param $id
     */
    public static function delete($id)
    {
        $db = Database::getInstance();
        $query = 'DELETE FROM ' . DaoClient::TABLE . ' WHERE NIF=:cod';
        $params = [
            ':cod' => $id,
        ];
        $db->queryExec($query, $params);
    }
}

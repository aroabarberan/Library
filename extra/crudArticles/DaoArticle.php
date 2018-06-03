<?php

include dirname(__FILE__) . '/Article.php';
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

class DaoArticle
{
    const TABLE = 'articulos';

    public function __construct()
    {
    }

    public static function create($article)
    {

        $db = connect();
        
        $params = [
            $article->getProperty('id'),
            $article->getProperty('nombre'),
            $article->getProperty('marca'),
            $article->getProperty('modelo'),
            $article->getProperty('precio'),
            $article->getProperty('familia'),
            $article->getProperty('imagen'),
            $article->getProperty('tipo'),
        ];
        $db->insert('Id, Nombre, Marca, Modelo, Precio, Familia, Imagen, Tipo', $params);

        $articles = $db->readAll();

        $db->queryExec($query, $params);
    }

    public static function read($idTable, $value)
    {

        $db = connect();
        $db->read($idTable, $value);
        $articles = $db->readAll();

        $article = new Article(
            $articles[0]['Id'],
            $articles[0]['Nombre'],
            $articles[0]['Marca'],
            $articles[0]['Modelo'],
            $articles[0]['Precio'],
            $articles[0]['Familia'],
            $articles[0]['Imagen'],
            $articles[0]['Tipo']
        );
        return $article;
    }

    public static function readAll()
    {
        $db = connect();
        
        $query = 'SELECT * FROM ' . DaoArticle::TABLE;
        $result = $db->queryExec($query);
        $articles = [];
        foreach ($result as $item) {
            $clie = new Client(
                $item['NIF'],
                $item['Nombre'],
                $item['Apellido1'],
                $item['Apellido2'],
                $item['Imagen'],
                $item['Tipo']
            );
            array_push($articles, $clie);
        }
        return $articles;
    }

    /**
     * @param Client $article
     */
    public static function update($article)
    {
        $db = Database::getInstance();
        $query = 'UPDATE ' . DaoArticle::TABLE . ' SET
        NIF = :nif, Nombre = :nombre, Apellido1 = :apellido1, Apellido2 = :apellido2,
        Imagen = :imagen, Tipo = :tipo
        WHERE NIF = :nif';

        $params = [
            ":nif" => $article->getNif(),
            ":nombre" => $article->getNombre(),
            ":apellido1" => $article->getApellido1(),
            ":apellido2" => $article->getApellido2(),
            ":imagen" => $article->getImagen(),
            ":tipo" => $article->getTipo(),
        ];
        $db->queryExec($query, $params);
    }

    /**
     * @param $id
     */
    public static function delete($id)
    {
        $db = Database::getInstance();
        $query = 'DELETE FROM ' . DaoArticle::TABLE . ' WHERE NIF=:cod';
        $params = [
            ':cod' => $id,
        ];
        $db->queryExec($query, $params);
    }

    private function connect() {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);
    }
}

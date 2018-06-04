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
        $article = $db->readAll();
    }

    public static function read($idTable, $value)
    {
        $db = connect();
        $db->read($idTable, $value);
        $article = $db->readAll();

        return new Article(
            $article['Id'],
            $article['Nombre'],
            $article['Marca'],
            $article['Modelo'],
            $article['Precio'],
            $article['Familia'],
            $article['Imagen'],
            $article['Tipo']
        );
    }

    public static function readAll()
    {
        $db = connect();
        $results = $db->readAll();
        $articles = [];

        foreach ($results as $article) {
            array_push($articles, new Article(
                $article['Id'],
                $article['Nombre'],
                $article['Marca'],
                $article['Modelo'],
                $article['Precio'],
                $article['Familia'],
                $article['Imagen'],
                $article['Tipo']
            ));
        return $articles;
        }
    }

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

    public static function delete($idTable, $value)
    {
        $db = connect();
        $db->remove($idTable, $value);        
    }

    private function connect() {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);
    }
}

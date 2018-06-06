<?php

include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

class DaoArticle
{
    const TABLE = 'articulos';

    public function __construct()
    {
    }

    public static function create($article)
    {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);
        $query = 'INSERT INTO ' . DaoArticle::TABLE . '
        (Id, Nombre, Marca, Modelo, Precio, Familia, Imagen, Tipo)
        VALUES (:id, :nombre, :marca, :modelo, :precio, :familia, :imagen, :tipo)';

        $params = [
            ":id" => $article->getProperty('id'),
            ":nombre" => $article->getProperty('nombre'),
            ":marca" => $article->getProperty('marca'),
            ":modelo" => $article->getProperty('modelo'),
            ":precio" => $article->getProperty('precio'),
            ":familia" => $article->getProperty('familia'),
            ":imagen" => $article->getProperty('imagen'),
            ":tipo" => $article->getProperty('tipo'),
        ];
        $db->query($query, $params);
    }

    public static function read($idTable, $value)
    {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);

        $article = $db->read($idTable, $value);

        return new Article(
            $article[0]['Id'],
            $article[0]['Nombre'],
            $article[0]['Marca'],
            $article[0]['Modelo'],
            $article[0]['Precio'],
            $article[0]['Familia'],
            $article[0]['Imagen'],
            $article[0]['Tipo']
        );
    }

    public static function readAll()
    {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);

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
        }
        return $articles;
    }

    public static function update($article)
    {

        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);

        $query = 'UPDATE ' . DaoArticle::TABLE . ' SET
        Id = :id, Nombre = :nombre, Marca = :marca, Modelo = :modelo, 
        Precio = :precio, Familia = :familia, Imagen = :imagen, Tipo = :tipo
        WHERE Id = :id';

        $params = [
            ":id" => $article->getProperty('id'),
            ":nombre" => $article->getProperty('nombre'),
            ":marca" => $article->getProperty('marca'),
            ":modelo" => $article->getProperty('modelo'),
            ":precio" => $article->getProperty('precio'),
            ":familia" => $article->getProperty('familia'),
            ":imagen" => $article->getProperty('imagen'),
            ":tipo" => $article->getProperty('tipo'),
        ];
        $db->query($query, $params);
    }

    public static function delete($idTable, $value)
    {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);
        $db->remove($idTable, $value);
    }
}

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

        $db->insert('Id, Nombre, Marca, Modelo, Precio, Familia, Imagen, Tipo',
            [
                $article->getProperty('id'),
                $article->getProperty('nombre'),
                $article->getProperty('marca'),
                $article->getProperty('modelo'),
                $article->getProperty('precio'),
                $article->getProperty('familia'),
                $article->getProperty('imagen'),
                $article->getProperty('tipo'),
            ]
        );
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

        $db->update(
            ['Id', 'Nombre', 'Marca', 'Modelo', 'Precio', 'Familia', 'Imagen', 'Tipo'],
            [
                $article->getProperty('id'),
                $article->getProperty('nombre'),
                $article->getProperty('marca'),
                $article->getProperty('modelo'),
                $article->getProperty('precio'),
                $article->getProperty('familia'),
                $article->getProperty('imagen'),
                $article->getProperty('tipo'),
            ]
        );
    }

    public static function delete($idTable, $value)
    {
        $db = new DataBasePDO();
        $db->setTable(DaoArticle::TABLE);
        $db->remove($idTable, $value);
    }
}

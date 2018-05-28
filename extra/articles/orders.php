<?php
include(dirname(__FILE__) . '/../../DataBase/DataBasePDO.php');
include(dirname(__FILE__) . '/../../Images/Image.php');

echo "<h2>Productos seleccionados</h2>";

$db = new DataBasePDO();
$db->setTable('articulos');

$articles= $_POST['articles'];


foreach ($articles as $key => $ar) {
    $article = $db->read('Id', $ar);
    // echo "<pre>" . print_r($article, true) . "</pre>";

    $string = base64_decode($article[$key]['Imagen']);
    $image = Image::createImageFromString($string);
    
    echo "Id: " . $article[$key]['Id'] . "<br>";
    echo "Nombre: " . $article[$key]['Nombre'] . "<br>";
    echo "Marca: " . $article[$key]['Marca'] . "<br>";
    echo "Modelo: " . $article[$key]['Modelo'] . "<br>";
    echo "Precio: " . $article[$key]['Precio'] . "<br>";
    echo "Familia: " . $article[$key]['Familia'] . "<br>";
    echo "Imagen: ";
    ?><img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"><br>
    <?php
    echo "Tipo: " . $article[$key]['Tipo'] . "<br>";
}



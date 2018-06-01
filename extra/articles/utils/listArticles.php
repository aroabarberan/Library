<?php
$db = new DataBasePDO();
$db->setTable('articulos');
$articles = $db->readAll();

foreach ($articles as $key => $article) {
    $string = base64_decode($article['Imagen']);
    $image = Image::createImageFromString($string);

    echo "ID: " . $article['Id'] . "<br>";
    echo "Nombre: " . $article['Nombre'] . "<br>";
    echo "MARCA: " . $article['Marca'] . "<br>";
    echo "MODELO: " . $article['Modelo'] . "<br>";
    echo "PRECIO: " . $article['Precio'] . "<br>";
    echo "FAMILIA: " . $article['Familia'] . "<br>";
    echo "IMAGEN: ";
    ?>
    <img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"><br>
    <?php
    echo "Tipo: " . $article['Tipo'];
    echo "<br><br>";
}
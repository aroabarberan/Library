<?php

include(dirname(__FILE__) . '/../../DataBase/DataBasePDO.php');
include(dirname(__FILE__) . '/../../Images/Image.php');

// desplegable que carge todas la familias y al selecconar familia muestre 
// todos los productos de esa familia


// sobre el ultimo ejercicio que permita con un check seleccionar tantos productos 
// como quieras el boton enviar lleva a la pagina en la que aparece los productos 
// que has seleccionado y el importe total

// modificar el anterior para que en el desplegable aparezca un numero del uno al diez
// el despegable muestra un registro por pagina
// si pones 3 muestra los tres primeros de 12 articulos (paginacion)

$db = new DataBasePDO();
$db->setTable('familias');
$families = $db->readAll();
?>

<form action="" method="POST">
    <div>
        <label for="family">Familias</label>
        <select name="family" id="family">
            <option value=""></option>
            <?php foreach($families as $family): ?>
                    <option value="<?= $family['Id']; ?>" 
                       <?php if(isset($_POST['family']) && $_POST['family'] == $family['Id']) echo 'selected';?>>
                       <?= $family['Nombre']?>
                    </option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Enviar" id="send" name="send">
    </div>
</form>

<?php
if (!isset($_POST['send'])) return;

$db->setTable('articulos');
$articles = $db->read('Familia', $_POST['family']);
?>
<table border="2px"> 
    <tr>
        <td>Id</td>
        <td>Nombre</td>
        <td>Marca</td>
        <td>Modelo</td>
        <td>Precio</td>
        <td>Familia</td>
        <td>Imagen</td>
        <td>Tipo</td>
        <td>Check</td>
    </tr>
    <form action="orders.php" method="POST">
    
        <?php 
        foreach ($articles as $key => $article) {
            ?>
            <tr>
            <?php
            $string = base64_decode($article['Imagen']);
            $image = Image::createImageFromString($string);
            ?>
            <td><?= $article['Id'] ?></td>
            <td><?= $article['Nombre'] ?></td>
            <td><?= $article['Marca'] ?></td>
            <td><?= $article['Modelo'] ?></td>
            <td><?= $article['Precio'] ?></td>
            <td><?= $article['Familia'] ?></td>
            <td><img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"></td>
            <td><?= $article['Tipo'] ?></td>
            <td><input type="checkbox" name="articles[] ?>" id="articles[]" value="<?= $article['Id'] ?>"></td>
            </tr>
            <?php
        }
        ?>
        <input type="submit" value="Enviar" name="sendArticle" id="sendArticle">
    </form>
</table>

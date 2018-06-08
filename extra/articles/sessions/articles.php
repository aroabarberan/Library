<?php

include dirname(__FILE__) . '/../../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../../Images/Image.php';
include dirname(__FILE__) . '/../../../Cookies/Cookie.php';

if (!Cookie::isExists('user')) {
    header("location:login.php");
}

$db = new DataBasePDO();
$db->setTable('familias');
$families = $db->readAll();

?>
<form action="logOut.php" method="post">
    <input type="submit" value="Log out" id="logOut">
</form>

<form action="" name='f1' id='f1' method="GET" onchange="f1.submit()">
    <div>
        <label for="family">Familias</label>
        <select name="family" id="family">
            <option value=""></option>
            <?php foreach($families as $family): ?>
                    <option value="<?= $family['Id']; ?>" 
                       <?php if(isset($_GET['family']) && $_GET['family'] == $family['Id']) echo 'selected';?>>
                       <?= $family['Nombre']?>
                    </option>
            <?php endforeach;?>
        </select>

        <input type="hidden" value="Enviar" id="send" name="send">
    </div>
</form>

<?php
if (!isset($_GET['family'])) return;

$db->setTable('articulos');
$articles = $db->read('Familia', $_GET['family']);
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
        
            foreach ($articles as $article) {
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
                <td><input type="checkbox" name="arr[<?= $article['Id']?>]" id="arr[<?= $article['Id']?>]"></td>
            </tr>
            <?php
        }
        ?>
</table>        
        <input type="submit" value="Enviar" name="sendArticle" id="sendArticle">
    </form>

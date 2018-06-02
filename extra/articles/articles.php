<?php

include(dirname(__FILE__) . '/../../DataBase/DataBasePDO.php');
include(dirname(__FILE__) . '/../../Images/Image.php');

$db = new DataBasePDO();
$db->setTable('familias');
$families = $db->readAll();
//  onchange="f1.submit()";
?>
<form action="" name='f1' id='f1' method="GET">
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

        <select name="articlesPerPage" id="articlesPerPage">
            <option value=""></option>
            <?php for($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>"
                    <?php if(isset($_GET['articlesPerPage']) && $_GET['articlesPerPage'] == $i) echo 'selected';?>>
                    <?= $i ?></option>
            <?php endfor;?>
        </select>

        <input type="submit" value="Enviar" id="send" name="send">
    </div>
</form>

<?php
if (!isset($_GET['send'])) return;

$db->setTable('articulos');
$totalArticles = $db->read('Familia', $_GET['family']);
$articlesPerPage = $_GET['articlesPerPage'];


if(isset($_GET['init'])) {
    $page = $_GET['init'];
    $init = 0 + $articlesPerPage;
} else {
    $page = 0;
    $init = 0;
}

$articles = $db->query("SELECT * from articulos WHERE Familia=$_GET[family] LIMIT $init, $articlesPerPage");

$size = count($totalArticles);
$numberLinks = round($size / $articlesPerPage);

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
                <td>
                    <input type="checkbox" name="arr[]" id="arr[]" 
                    value="<?= $article['Id']?>"  
                    <?php if(isset($_POST['arr']) && $_POST['arr'] ==  $articles['Id']) echo 'checked';?>>
                </td>
            </tr>
            <?php
        }
        ?>
</table>        
        <input type="submit" value="Enviar" name="sendArticle" id="sendArticle">
    </form>

<?php for ($i = 0; $i < $numberLinks; $i++): ?>
    <a href="articles.php?family=<?= $_GET['family'] ?>&articlesPerPage=<?= $_GET['articlesPerPage'] ?>&send=Enviar&init=<?php echo $i + 1?>"> <?php echo $i +1 ?></a>
<?php endfor; ?>

<?php

include(dirname(__FILE__) . '/../../DataBase/DataBasePDO.php');
include(dirname(__FILE__) . '/../../Images/Image.php');

$db = new DataBasePDO();
$db->setTable('familias');
$families = $db->readAll();
echo "al;skdmkal";
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
if (!isset($_GET['family'])) return;

$db->setTable('articulos');
$articles = $db->read('Familia', $_GET['family']);

$init = 1;
$size = count($articles) - 1;
$articlesPerPage = $_GET['articlesPerPage'];
$numberLinks = floor($size / $articlesPerPage) -1;

if(isset($_GET['init'])) $page = $_GET['init'];
$page = 1;

$init = $articlesPerPage * $page;
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
        
        for($i = $init; $i < $init + $articlesPerPage; $i++) {
            ?>
            <tr>
                <?php
                $string = base64_decode($articles[$i]['Imagen']);
                $image = Image::createImageFromString($string);
                ?>
                <td><?= $articles[$i]['Id'] ?></td>
                <td><?= $articles[$i]['Nombre'] ?></td>
                <td><?= $articles[$i]['Marca'] ?></td>
                <td><?= $articles[$i]['Modelo'] ?></td>
                <td><?= $articles[$i]['Precio'] ?></td>
                <td><?= $articles[$i]['Familia'] ?></td>
                <td><img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"></td>
                <td><?= $articles[$i]['Tipo'] ?></td>
                <td>
                    <input type="checkbox" name="arr[]" id="arr[]" 
                    value="<?= $articles['Id']?>"  
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
    <!-- <a href="articles.php?init=<?php echo $i + 1?>"> <?php echo $i +1 ?></a> -->
    <a href="articles.php?family=<?= $_GET['family'] ?>&articlesPerPage=<?= $_GET['articlesPerPage'] ?>&send=Enviar&init=<?php echo $i + 1?>"> <?php echo $i +1 ?></a>
<?php endfor; ?>

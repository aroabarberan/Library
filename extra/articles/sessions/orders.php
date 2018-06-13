<?php
include dirname(__FILE__) . '/../../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../../Images/Image.php';
include dirname(__FILE__) . '/../../../Cookies/Cookie.php';

session_start();

if (!Cookie::isExists('user')) {
    header("location:login.php");
}
echo "<h2>Productos seleccionados</h2>";

$db = new DataBasePDO();
$db->setTable('articulos');


if (isset($_POST['delete'])) {
    $remove = $_POST['remove'];
    foreach ($remove as $key => $value) {
        if ($_SESSION['basket'][$key] > 1) {
            $_SESSION['basket'][$key] -= 1;
        } else {
            unset($_SESSION['basket'][$key]);
        }
    }
}

if (isset($_POST['arr'])) {
    $articles = $_POST['arr'];

    foreach ($articles as $key => $article) {
        if (!isset($_SESSION['basket'][$key])) {
            $_SESSION['basket'][$key] = 1;
        } else {
            $_SESSION['basket'][$key] += 1;
        }
    }
}
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
        <td>Cantidad</td>
        <td>Eliminar</td>
    </tr>

    <form action="orders.php" method="POST">
        <?php
            $sum = 0;
            foreach ($_SESSION['basket'] as $key => $ar) {
        ?>
        <tr>
            <?php                    
                $article = $db->read('Id', $key);
                $string = base64_decode($article[0]['Imagen']);
                $image = Image::createImageFromString($string);
            ?>
            <td><?=$article[0]['Id']?></td>
            <td><?=$article[0]['Nombre']?></td>
            <td><?=$article[0]['Marca']?></td>
            <td><?=$article[0]['Modelo']?></td>
            <td><?=$article[0]['Precio']?></td>
            <td><?=$article[0]['Familia']?></td>
            <td><img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"></td>
            <td><?=$article[0]['Tipo']?></td>
            <td> <?= $_SESSION['basket'][$key] ?></td>
            <td><input type=checkbox name=remove[<?=$article[0]['Id']?>]></td>
        </tr>
        <?php
            $sum += $article[0]['Precio'] * $_SESSION['basket'][$key];
        }
        ?>
        <tr>
            <td colspan="8">PRECIO TOTAL</td>
            <td colspan="2"><?=$sum?></td>
        </tr>
</table>
        <a href=articles.php>Seguir Comprando</a>
        <input type="submit" value="Eliminar" name="delete">
    </form>

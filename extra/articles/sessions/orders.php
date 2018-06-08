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

if (isset($_POST['arr'])) {
    $articles = array_keys($_POST['arr']);
} else {
    $articles = [];
}
foreach ($articles as $key => $article) {
    if (!isset($_SESSION['basket']) || !in_array($article, $_SESSION['basket'])) {
        $_SESSION['basket'][$articles[$key]] = $article;
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
            foreach ($_SESSION['basket'] as $ar) {
        ?>
        <tr>
            <?php                    
                $article = $db->read('Id', $ar);
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
            <td><input type="number" name="amount[<?=$article[0]['Id']?>]" value=""></td>
            <td><input type=checkbox name=remove[<?=$article[0]['Id']?>] value=<?=$article[0]['Id']?>></td>
        </tr>
        <?php
            $sum += $article[0]['Precio'];
        }
        ?>
        <tr>
            <td colspan="6">PRECIO TOTAL</td>
            <td colspan="2"><?=$sum?></td>
        </tr>
</table>
        <input type="submit" value="Eliminar" name="delete">
    </form>

<?php
if (!isset($_POST['delete'])) return;

if (isset($_POST['remove'])) {
    $remove = $_POST['remove'];
    foreach ($remove as $key => $value) {
        unset($_SESSION['basket'][$key]);
    }
}

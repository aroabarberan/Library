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
$articles= $_POST['arr'];
$basket = $_SESSION['basket'];

foreach ($articles as $key=>$valor) {
    if ( !isset($basket[$key])) {
		$basket[$key]=1;
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
    </tr>
    
    <?php
    $sum = 0;
    foreach ($basket as $ar) {
        ?>
        <tr>
            <?php
            $article = $db->read('Id', $ar);
            $string = base64_decode($article[0]['Imagen']);
            $image = Image::createImageFromString($string);
            ?>
            <td><?= $article[0]['Id'] ?></td>
            <td><?= $article[0]['Nombre'] ?></td>
            <td><?= $article[0]['Marca'] ?></td>
            <td><?= $article[0]['Modelo'] ?></td>
            <td><?= $article[0]['Precio'] ?></td>
            <td><?= $article[0]['Familia'] ?></td>
            <td><img src='<?=$image->getSrc();?>' style="width: 100px; hight: 100px;"></td>
            <td><?= $article[0]['Tipo'] ?></td>
        </tr>
        <?php
        $sum += $article[0]['Precio'];
    }
    ?>
    <tr>
        <td colspan="6">PRECIO TOTAL</td>
        <td colspan="2"><?= $sum ?></td>
    </tr>
</table>  

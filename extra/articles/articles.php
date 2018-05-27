<?php

include(dirname(__FILE__) . '/../../DataBase/DataBasePDO.php');
include(dirname(__FILE__) . '/../../Images/Image.php');

// desplegable que carge todas la familias y al selecconar familia muestre 
// todos los productos de esa familia


// sobre el ultimo ejercicio que permita con un check seleccionar tantos productos como quieras
// el boton enviar leva a la pagina en la que aparece los productos que has seleccionado y el importe total

// modificar el anterior para que en el desplegable aparexca un numero del uno al diez
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

echo $_POST['family'];
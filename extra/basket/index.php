
<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

$db = new DataBasePDO();
$db->setTable('familia');
$families = $db->readAll();
?>

<form action="" method="POST">
    <div>
        <label for="family">Familia</label>
        <select name="family"><br>
            <option value=""></option>
                <?php foreach($families as $family): ?>
                <option value="<?= $family['cod']; ?>"
                   <?php if(isset($_POST['family']) && $_POST['family'] == $family['cod']) echo 'selected';?>>
                   <?= $family['nombre']?>
                </option>
                <?php endforeach;?>
        </select>
    </div>
    <div>
        <label for="name">Nombre Producto</label>
        <input type=text name="name" value=<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>>
    </div>
    <div>
        <input type=submit name="search" value=buscar>
    </div>
</form>

<?php
if (!isset($_POST['search'])) return;

$family = $_POST['family'];
$name = $_POST['name'];
$query = "SELECT p.cod,p.nombre_corto,p.PVP,b.suma FROM  
        (SELECT s.producto,sum(s.unidades) AS suma FROM stock s GROUP BY 1) 
        b,producto p WHERE p.cod=b.producto ";

$params = [];
if (!empty($family)) {
    $query .= " and familia=:familia ";
    $params[":familia"] = $family;
}
if (!empty($name)) {
    $query .= " and nombre_corto like :nombre_corto";
    $params[":nombre_corto"] = "%" . $name . "%";
}
$rows = $db->query($query, $params);

$db->setTable('clientes');
$clients = $db->readAll();
$cont = 0;
?>
<form name=f2 action=pedir.php method=post>
    <div>
        <label for="client">Cliente</label>
        <select name="client" id="client">
            <option value=""></option>
            <?php foreach($clients as $client): ?>
                <option value="<?= $client['NIF']; ?>"
                    <?php if(isset($_POST['client']) && $_POST['client'] == $client['NIF']) echo 'selected';?>>
                    <?= $client['Apellido1'] . " " .  $client['Apellido2'] . " " . $client['Nombre']?>
                </option>
            <?php endforeach;?>
        </select>
    </div>
    <table border="2px">
        <tr>
            <td>Seleccionar</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Cantidad</td>
        </tr>
        <?php foreach($rows as $row): ?>
            <tr>
                <td><input type=checkbox name=pro[$cont] value=$fila[cod]></td>
                <td><?= $row['nombre_corto'] ?></td>
                <td><?= $row['PVP'] ?></td>
                <!-- <td><?= $fila['suma'] ?></td> -->
                <td><input type="text" size="4" name="cant[$cont]"></td>
                <input type=hidden name=stock[$cont] value=$fila[suma]>
                <input type=hidden name=pvp[$cont] value=$fila[PVP]>";
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" value="pedir">
</form>
<?php
// $cont = 0;
// echo "<table border=2>";
// echo "<tr><td>Seleccionar</td><td>Nombre</td><td>Precio</td><td>Stock</td><td>Cantidad</td></tr>";
// foreach ($rows as $fila) {
//     echo "<tr>";
//     echo "<td><input type=checkbox name=pro[$cont] value=$fila[cod]></td>
//     <td>" . $fila['nombre_corto'] . "</td><td>" . $fila['PVP'] . "</td>
//     <td>" . $fila['suma'] . "</td>
//     <td><input type=text size=4 name=cant[$cont]></td>
//     <input type=hidden name=stock[$cont] value=$fila[suma]>
//     <input type=hidden name=pvp[$cont] value=$fila[PVP]>";
//     echo "</tr>";
//     $cont++;
// }
// echo "</table>";
// echo "<input type=submit value=pedir>";
// echo "</form>";

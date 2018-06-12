<?php
require_once "libreria.php";
require_once "procesar.php";

?>

<h1>FACTURA DEL CLIENTE</h1>
<?php

$db = conectaDb();

$consulta = "select Nombre, Apellido1, Apellido2 from clientes WHERE NIF ='$_POST[cliente]'";
$comprador = consultaSelect($db, $consulta);
echo "<h2> El cliente " . $comprador[0]['Nombre'] . ' ' . $comprador[0]['Apellido1'] . ' ' . $comprador[0]['Apellido2'] . '</h2>';

$mensaje = "<h2>Ha comprado los productos:<br><br>";
foreach ($_POST['pro'] as $key => $produc) {
    $mensaje .= "&nbsp&nbsp&nbsp&nbsp =>   &nbsp";
    $mensaje .= $produc . ' con precio de ' . $_POST['pvp'][$key] . '<br>';
}
echo $mensaje . '</h2>';
echo '<h2>Total de lo que tiene que pagar es de: ' . array_sum($_POST['pvp']) . '</h2>';

function mostrarError($mensaje)
{
    echo "<font color=red size=5>$mensaje</font>";
    echo "<a href=index.php>Repetir Pedido</a>";
}

function CantidadDisponible($stock, $cantidades)
{
    $i = 0;
    while (($i < count($stock)) && ($stock[$i] >= $cantidades[$i])) {
        $i++;
    }
    return (count($stock) == $i);
}

$cli1 = $_POST['cliente'];
$fecha = time();
$db = conectaDb();
$consulta = "insert into pedidos values(NULL, :cliente, :fecha)";
$param = array(":cliente" => $cli1, ":fecha" => $fecha);
consultaSimpleSeg($db, $consulta, $param);

$consulta = "select max(Id) as IdPed from pedidos";
$filas = consultaSelect($db, $consulta);

list($clave, $fila) = each($filas);
$codPed = $fila['IdPed'];

if (!isset($_POST['stock'])) {
    mostrarError("Error!!. No hay producto seleccionado");
} else if (!CantidadDisponible($_POST['stock'], $_POST['cant'])) {
    mostrarError("Error!!. No hay cantidades disponibles");
} else {
    $pro1 = $_POST['pro'];
    $cant1 = $_POST['cant'];
    $stock1 = $_POST['stock'];

    foreach ($pro1 as $clave => $valor) {
        if ($cant1[$clave] <= 0) {
            mostrarError("Error!!. Debes introducir una cantidad en cada producto");
        } else {
            $consulta = "insert into detpedido values (:pedido, :producto, :cantidad, :descuento)";
            $param = array(":pedido" => $codPed, ":producto" => $pro1[$clave], ":cantidad" => $cant1[$clave], ":descuento" => 0);
            consultaSimpleSeg($db, $consulta, $param);
            reduceStock($db, $pro1[$clave], $cant1[$clave]);
        }

    }
}

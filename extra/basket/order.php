<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/Process.php';

?>

<h1>FACTURA DEL CLIENTE</h1>
<?php
$client = $_POST['client'];
$db = new DataBasePDO();
$db->setTable('clientes');
$buyer = $db->query("SELECT Nombre, Apellido1, Apellido2 FROM clientes WHERE NIF ='$client'");
$message = "<h2>El cliente " . $buyer[0]['Nombre'] . " " . $buyer[0]['Apellido1'] . " " . $buyer[0]['Apellido2'];
?>

<?php
$message .= "<br>Ha comprado los siguientes productos:<br><br>";
foreach ($_POST['pro'] as $key => $produc) {
    $message .= "&nbsp&nbsp&nbsp&nbsp =>   &nbsp";
    $message .= $produc . ' con precio de ' . $_POST['pvp'][$key] . '<br>';
}
echo $message . '</h2>';
echo '<h2>Total de lo que tiene que pagar es de: ' . array_sum($_POST['pvp']) . '</h2>';

$date = time();
$db->setTable('pedidos');

$query = "INSERT INTO pedidos VALUES (:cod, :client, :fecha)";

$params = [
    ":cod" => rand(0, 100),
    ":client" => $client,
    ":fecha" => $date,
];
$db->query($query, $params);
$db->setTable('pedidos');
$codLastOrder = $db->readAll()[count($db->readAll()) - 1];

if (!isset($_POST['stock'])) {
    Process::showError("Error!!. No hay producto seleccionado");
}
if (!Process::amountAvailable($_POST['stock'], $_POST['cant'])) {
    Process::showError("Error!!. No hay cantidades disponibles");
}

$products = $_POST['pro'];
$amounts = $_POST['cant'];
$stock = $_POST['stock'];

foreach ($products as $key => $product) {
    if ($amounts[$key] <= 0) {
        Process::showError("Error!!. Debes introducir una cantidad en cada producto");
    } else {
        $query = "INSERT INTO detpedido VALUES (:pedido, :producto, :cantidad)";
        $param = [
            ":pedido" => $codLastOrder['Cod'],
            ":producto" => $product,
            ":cantidad" => $amounts[$key],
        ];
        // echo "<pre>" . print_r($product, true);
        // $db->query($query, $params);
        Process::reduceStock($product, $amounts[$key]);
    }

}

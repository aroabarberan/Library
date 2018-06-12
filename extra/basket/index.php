
<form name=f1 method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
        <label for="familia">Familia</label>
        <select name=familia><br>
            <option value=""></option>
            <?php
                require_once "libreria.php";
                $db = conectaDb();
                $consulta = "select * from familia";
                $filas = ConsultaSelect($db, $consulta);
                $family = "";
                if (isset($_POST['familias'])) {
                    $family = $_POST['familias'];
                }
                foreach ($filas as $fila) {
                    $linea = "<option value=$fila[cod] ";
                    if ($fila['cod'] == $family) {
                        $linea .= " selected ";
                    }
                    $linea .= " >$fila[nombre]</option>";
                    echo $linea;
                }
                cerrarDb($db);
                ?>
        </select>
    </div>
    <div>
        <label for="nombre">Nombre Producto</label>
        <input type=text name=nombre value=<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>>
    </div>
    <div>
        <input type=submit name=buscar value=buscar>
    </div>
</form>
<?php
if (!isset($_POST['buscar'])) {
    return;
}

$family = $_POST['familia'];
$name = $_POST['nombre'];
$consulta = "SELECT p.cod,p.nombre_corto,p.PVP,b.suma
            FROM  ( SELECT s.producto,sum(s.unidades) AS suma FROM stock s GROUP BY 1) b,producto p
            WHERE p.cod=b.producto ";
$param = array();
if (!empty($family)) {
    $consulta .= " and familia=:familia ";
    $param[":familia"] = $family;
}
if (!empty($name)) {
    $consulta .= " and nombre_corto like :nombre_corto";
    $param[":nombre_corto"] = "%" . $name . "%";
}
$filas = ConsultaSelectSeg($db, $consulta, $param);

echo "<form name=f2 action=pedir.php method=post>";
echo "Clientes <select name=cliente>";
$consulta = "select nif, nombre, apellido1, apellido2 from clientes";
$filas2 = consultaSelect($db, $consulta);
foreach ($filas2 as $fila) {
    echo "<option value=$fila[nif]>$fila[apellido1] $fila[apellido2], $fila[nombre]</option>";
}
echo "</select><br><br>";

$cont = 0;
echo "<table border=2>";
echo "<tr><td>Seleccionar</td><td>Nombre</td><td>Precio</td><td>Stock</td><td>Cantidad</td></tr>";
foreach ($filas as $fila) {
    echo "<tr>";
    echo "<td><input type=checkbox name=pro[$cont] value=$fila[cod]></td>
    <td>" . $fila['nombre_corto'] . "</td><td>" . $fila['PVP'] . "</td>
    <td>" . $fila['suma'] . "</td>
    <td><input type=text size=4 name=cant[$cont]></td>
    <input type=hidden name=stock[$cont] value=$fila[suma]>
    <input type=hidden name=pvp[$cont] value=$fila[PVP]>";
    echo "</tr>";
    $cont++;
}
echo "</table>";
echo "<input type=submit value=pedir>";
echo "</form>";

<?php
session_start();
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
echo sha1("aroa");

?>
<form name=f1 method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
        <label for="user">Usuario</label>
        <input type=text name="user">
    </div>
    <div>
        <label for="password">Clave</label>
        <input type=password name=clave>
    </div>

    <?php

function showCaptcha()
{

}

function locked($user)
{
    $db = new DataBasePDO();
    $db->setTable('logs');
    $locked = false;
    $time = time();

    $query = "SELECT hora,acceso FROM logs WHERE BINARY Usuario=:user
                order by Hora desc limit 3";

    $param = array(":user" => $user);
    $rows = $db->query($query, $param);
    $cont = 0;

    foreach ($rows as $row) {
        if ($row['Acceso'] == "D") {
            $cont++;
        }
    }
    if ($cont == 3) {
        $locked = true;
    }
    return $locked;
}

?>
    <input type="submit" value="Enviar" name="send">
</form>

<?php

if (!isset($_POST['send'])) {
    return;
}

$db = new DataBasePDO();
$user = $_POST['user'];
$password = sha1("qm&h*" . $_POST['password'] . "pg!@");

$query = "SELECT count(*) as cuenta from usuarios
    where BINARY Usuario=:usuario and BINARY Clave=:clave";

$param = array(":usuario" => $user, ":clave" => $password);
$rows = $db->query($query, $param);
list($clave, $fila) = each($rows);

echo "<pre>" . print_r($rows, true) . "</pre>";

if (locked($_POST['user'])) {
    echo "true";
} else {
    echo "false";
}
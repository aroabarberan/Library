<?php
include dirname(__FILE__) . '/../../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../../Images/Image.php';

include dirname(__FILE__) . '/../../../Cookies/Cookie.php';
include dirname(__FILE__) . '/../../../Cookies/utilsCookie.php';

include dirname(__FILE__) . '/../../../Dates/Convertion.php';
include dirname(__FILE__) . '/../../../Dates/Date.php';
include dirname(__FILE__) . '/../../../Dates/FamilyDate.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();
// echo sha1("aroa");

function locked($userName)
{
    $db = new DataBasePDO();
    $db->setTable('logs');
    $locked = false;

    $query = "SELECT hora,acceso FROM logs WHERE BINARY Usuario=:userName
                order by Hora desc limit 3";

    $rows = $db->query($query, [":userName" => $userName]);
    $cont = 0;

    foreach ($rows as $row) {
        if ($row['acceso'] == "D") {
            $cont++;
        }
    }

    if ($cont == 3) {
        $locked = true;
        if (!isset($_SESSION['login'])) {
            $date = new Date($rows[2]['hora']);

            $dateUnlock = FamilyDate::convertToSeconds(
                $date->getYear(),
                $date->getNumberMonth(),
                $date->getDay(),
                $date->getHour(),
                $date->getMinute() + 5,
                $date->getSeconds()
            );
            $dateTemp = new Date($dateUnlock);
            $_SESSION['login'] = $dateTemp->getSecondsUnix();
        }
    }
    if ($locked == true) {
        if ((time() - $_SESSION['login']) > 300) {
            $locked = false;
        } else {
            $time = getdate($_SESSION['login'] + 300);
            echo "Está bloqueado hasta las " . $time['hours'] . ":" . $time['minutes'] . ":" . $time['seconds'];
        }
    }

    return $locked;
}

?>

<form name=f1 method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
        <label for="userName">UserName</label>
        <input type=text name="userName" value="<?php if (isset($_POST['userName'])) {echo $_POST['userName'];}?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php if (isset($_POST['password'])) {echo $_POST['password'];}?>">
    </div>
    <input type="submit" value="Enviar" id="send" name="send">
</form>

<?php

if (!isset($_POST['send'])) {
    return;
}

$userName = $_POST['userName'];
$password = sha1($_POST['password']);

$time = time();
$db = new DataBasePDO();
$db->setTable('usuarios');
$users = $db->readAll();
$access = 'D';


if (locked($userName)) {
    echo "Esta bloqueado";
} else {
    echo "No esta bloqueado";
    if (isLogin($users, $userName, $password)) {
        $cookie = new Cookie('user', $userName);
        $access = 'C';
        header("location: articles.php");
    } else {
        $access = 'D';
        echo "Login incorrecto<br>";
    }
}

$query = "INSERT INTO logs VALUES (NULL, :userName, $time, '$access')";
$db->query($query, [":userName" => $userName]);
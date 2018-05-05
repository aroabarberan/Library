<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../Images/Image.php';
include dirname(__FILE__) . '/../../Cookies/Cookie.php';
include dirname(__FILE__) . '/../../Cookies/utilsCookie.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// echo sha1("aroa");
?>
<form name=f1 method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
        <label for="userName">UserName</label>
        <input type=text name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
    </div>

    <?php

function showCaptcha($userName, $password)
{
    ?>
    <table border=2>
    <tr>
        <td>Numeros</td>
        <td>A</td>
        <td>B</td>
        <td>C</td>
        <td>D</td>
        <td>E</td>
    </tr>
    <?php
    $letter = "ABCDE";
    $col = $letter[rand(0, strlen($letter) - 1)];
    $row = rand(0, 4);

    for ($i = 0; $i < 5; $i++): ?>
        <tr>
            <td> <?=$i?></td>
            <?php
            for ($j = 0; $j < 5; $j++):
                $image[$i] = new Image(100, 75);
                $image[$i]->fill($image[$i]->getColorRandom());
                $letters = $image[$i]->generateLettersRandom(6);

                $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorRandom(), -40);
                $image[$i]->paintLineRandom(5, 100, 75, $image[$i]->getColorRandom());

                if ($col == $letter[$j]) {
                    if ($row == $i) {
                        echo $letters;
                        $captcha = $letters;
                    }
                }
            ?>
		    <td><img src="<?=$image[$i]->getSrc();?>" alt=""></td>
	        <?php endfor;?>
        </tr>
    <?php endfor;?>
</table>

<form action="" method="post">
    <label for="resultCaptcha"><?=$row . $col?>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </label>
    <input type="hidden" name=letters value="<?=$captcha?>">
    <input type="submit" name="sendCaptcha" id="sendCaptcha" value="Enviar">
</form>

<?php
    $db = new DataBasePDO();
    $db->setTable('usuarios');
    $users = $db->readAll();

    if (isLogin($users, $userName, $password)) {
        if (isset($_POST['sendCaptcha'])) {
            if ($_POST['letters'] == $_POST['resultCaptcha']) {
                echo "Coincide";
            } else {
                echo "No coincide";
            }    
        }
    }
}

function locked($userName)
{
    $db = new DataBasePDO();
    $db->setTable('logs');
    $locked = false;

    $query = "SELECT hora,acceso FROM logs WHERE BINARY Usuario=:userName
                order by Hora desc limit 3";

    $params = array(":userName" => $userName);
    $rows = $db->query($query, $params);
    $cont = 0;

    foreach ($rows as $row) {
        if ($row['acceso'] == "D") {
            $cont++;
        }
    }
    if ($cont == 3) {
        $locked = true;
    }
    return $locked;
}

?>
    <input type="submit" value="Enviar" id="send" name="send">
</form>

<?php

if (!isset($_POST['send'])) {
    return;
}

$db = new DataBasePDO();
$userName = $_POST['userName'];
$password = sha1($_POST['password']);

$query = "SELECT count(*) as cuenta from usuarios
    where BINARY Usuario=:userName and BINARY Clave=:pass";

$params = [
    ":userName" => $userName,
    ":pass" => $password,
];
$rows = $db->query($query, $params);

$time = time();
$login = false;
$db->setTable('usuarios');
$users = $db->readAll();

if (isLogin($users, $userName, $password)) {
    $cookie = new Cookie('user', $userName);
    if (isset($_POST['resultCaptcha'])) {
        if ($_POST['resultCaptcha'] != $_POST['letters']) {
            $access = 'D';            
            echo "Valor captcha incorrecto";            
        } else {
            $access = 'C';
            $login = true;
            echo "Login correcto";
            header("location:index.php");            
        }
    } else {
        $access = 'C';
        $login = true;
        echo "Login correcto";
        header("location:index.php");                    
    }
    header("location:index.php");
} else {
    $access = 'D';    
    echo "Login incorrecto";
}


if (locked($userName) && !$login) {
    $query = "INSERT INTO logs VALUES (NULL, :userName, $time, '$access')";
    $db->query($query, [":userName" => $userName]);
    
    showCaptcha($userName, $password);
} else {
    $query = "INSERT INTO logs VALUES (NULL, :userName, $time, '$access')";
    $db->query($query, [":userName" => $userName]);
}

if ($access == 'C') {
    echo "REDIRIGIRIA Al INDEX";
    // header("Location: index.php");
}
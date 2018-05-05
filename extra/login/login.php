<?php
session_start();
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../Images/Image.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// echo sha1("aroa");
?>
<form name=f1 method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div>
        <label for="user">Usuario</label>
        <input type=text name="user">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    <?php

function showCaptcha()
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
    <input type="submit" name="send" id="send" value="Send">
</form>

<?php

    // if (isset($_POST['send'])) {
    //     if ($_POST['letters'] == $_POST['resultCaptcha']) {
    //         echo "Coincide";
    //     } else {
    //         echo "No coincide";
    //     }    
    // }
}

function locked($user)
{
    $db = new DataBasePDO();
    $db->setTable('logs');
    $locked = false;

    $query = "SELECT hora,acceso FROM logs WHERE BINARY Usuario=:user
                order by Hora desc limit 3";

    $params = array(":user" => $user);
    $rows = $db->query($query, $params);
    $cont = 0;

    foreach ($rows as $row) {
        if ($row['acceso'] == "D") {
            $cont++;
        }
    }
    if ($cont == 2) {
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
$password = sha1($_POST['password']);

$query = "SELECT count(*) as cuenta from usuarios
    where BINARY Usuario=:user and BINARY Clave=:pass";

$params = [
    ":user" => $user,
    ":pass" => $password,
];
$rows = $db->query($query, $params);

if ($rows[0]['cuenta'] == 1) {
    if (isset($_POST['resultCaptcha'])) {
        if ($_POST['resultCaptcha'] != $_POST['letters']) {
            echo "Valor captcha incorrecto";
            $access = 'D';
        } else {
            echo "Login correcto ";
            $_SESSION['user'] = $user;
            $access = 'C';
            $login = true;
        }
    } else {
        echo "Login correcto ";
        $_SESSION['user'] = $user;
        $access = 'C';
        $login = true;
    }
} else {
    echo "Login incorrecto";
    $access = 'D';
}

if (locked($user) && !$login) {
    showCaptcha();
    $query = "INSERT INTO logs VALUES (NULL, :user, $time, '$access')";
    $db->query($query, [":user" => $user]);
} else {
    $time = time();
    $query = "INSERT INTO logs VALUES (NULL, :user, $time, '$access')";
    $db->query($query, [":user" => $user]);
}
if ($access == 'C') {
    header("Location: index.php");
}
<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../Images/Image.php';
include dirname(__FILE__) . '/../../Cookies/Cookie.php';
include dirname(__FILE__) . '/../../Cookies/utilsCookie.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// echo sha1("aroa");

function showCaptcha($userName, $password)
{
    ?>
    <table border=2>
    <tr>
        <td>Nums</td>
        <?php
        $letter = "ABCDE";
        $length = strlen($letter);
        for ($i = 0; $i < $length; $i++): ?>
            <td><?=$letter[$i]?></td>   
        <?php endfor;?>
    </tr>
    <?php
    $col = $letter[rand(0, strlen($letter) - 1)];
    $row = rand(0, 4);

    for ($i = 0; $i < $length; $i++): ?>
        <tr>
            <td> <?=$i?></td>
            <?php
            for ($j = 0; $j < $length; $j++):
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

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div>
        <label for="resultCaptcha"><?=$row . $col?></label>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </div>

    <input type="hidden" name=letters value="<?=$captcha?>">
    <input type="submit" name="sendCaptcha" id="sendCaptcha" value="Enviar">
</form>

<?php
    //TODO => check captcha
}

function locked($userName)
{
    $db = new DataBasePDO();
    $db->setTable('logs');
    $locked = false;

    $query = "SELECT hora,acceso FROM logs WHERE BINARY Usuario=:userName
                order by Hora desc limit 3";

    $rows = $db->query($query, [":userName" => $userName]);
    $cont = 1;

    foreach ($rows as $row) {
        if ($row['acceso'] == "D") $cont++;
    }
    if ($cont == 3) $locked = true;
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

if (isLogin($users, $userName, $password)) {
    $cookie = new Cookie('user', $userName);
    $access = 'C';
    $login = true;
    echo "Login correcto";
    header("location:index.php");
    // if (isset($_POST['resultCaptcha'])) {
        // if ($_POST['resultCaptcha'] != $_POST['letters']) {
        //     $access = 'D';
        //     $login = false;
        //     echo "Valor captcha incorrecto";
        // } else {
        //     $access = 'C';
        //     $login = true;
        //     echo "Login correcto";
        //     header("location:index.php");
        // }
} else {
    $access = 'D';
    $login = false;
    echo "Login incorrecto";
}

if (locked($userName) && !$login) showCaptcha($userName, $password);

$query = "INSERT INTO logs VALUES (NULL, :userName, $time, '$access')";
$db->query($query, [":userName" => $userName]);

if ($access == 'C') {
    header("Location: index.php");
}
<?php
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../Cookies/Cookie.php';
include dirname(__FILE__) . '/../../Images/Image.php';
include dirname(__FILE__) . '/../../Cookies/utilsCookie.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);
ob_start();
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
    <div>
        <label for="resultCaptcha"><?=$row . $col?></label>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </div>

    <input type="hidden" name="letters" value="<?=$captcha?>">
    <input type="submit" value="Enviar" id="send" name="send">
</form>
<?php
if (isset($_POST['send'])) {
    $userName = $_POST['userName'];
    $password = sha1($_POST['password']);

    $db = new DataBasePDO();
    $db->setTable('usuarios');
    $users = $db->readAll();
    $time = time();

    if ($_POST['letters'] == $_POST['resultCaptcha']) {
        if (isLogin($users, $userName, $password)) {
            echo $userName;
            $cookie = new Cookie('user', $userName);
            $access = 'C';
            $login = true;
            echo "Login correcto";
            header("Location: index.php");
        } else {
            $access = 'D';
            $login = false;
            echo "Login incorrecto";
        }
    } else {
        $access = 'D';
        $login = false;
        echo "Captcha incorrecto";
        header("Location: index.php");
    }
    $query = "INSERT INTO logs VALUES (NULL, :userName, $time, '$access')";
    $db->query($query, [":userName" => $userName]);

}
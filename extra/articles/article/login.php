<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include dirname(__FILE__) . '/../../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../../Images/Image.php';
include dirname(__FILE__) . '/../../../Cookies/Cookie.php';
include dirname(__FILE__) . '/../../../Cookies/utilsCookie.php';

session_start();
// echo sha1("menganito");

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

$db = new DataBasePDO();
$db->setTable('usuarios');
$users = $db->readAll();

if (isLogin($users, $userName, $password)) {
    $cookie = new Cookie('user', $userName);
    header("location: articles.php");
} else {
    echo "Incorrect Login";
}

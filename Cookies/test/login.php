<?php

include dirname(__FILE__) . '/../Cookie.php';
include dirname(__FILE__) . '/../utilsCookie.php';
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

$db = new DataBasePDO();
$db->setTable('usuarios');
$users = $db->readAll();
echo "<pre>" . print_r($users, true) . "</pre>";

if (!empty($_POST['userName'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if (isLogin($users, $userName, $password)) {
        $cookie = new Cookie('user', $userName);
        header("location:content.php");
    } else {
        header("location:login.php");
    }
}

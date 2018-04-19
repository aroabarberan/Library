<?php

include dirname(__FILE__) . '/../Cookie.php';
include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

$db = new DataBasePDO();
$db->setTable('usuarios');
$users = $db->readAll();
echo "<pre>" . print_r($users, true) . "</pre>";

if (!empty($_POST['userName'])) {

    $userName = $_POST['userName'];
    $password = $_POST['password'];
    // $db->insert('Usuario, Clave', [$userName, $password]);

}
//     if (isExists($userName)) {
//         header("location:content.php");
//     }

if (Cookie::islogin($users, $userName, $password)) {
    Cookie::create($userName);
    // setcookie($userLogin, $userName, time() + 3600);
    header("location:content.php");
} else {
    header("location:login.php");
}


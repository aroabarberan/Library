<?php
ini_set(‘display_errors’, ‘On’);
error_reporting(E_ALL);

require_once '../functionsCookies.php';
require_once '../../DataBase/DataBasePDO.php';

// $db = new DataBasePDO();
// $db->setTable('usuarios');
// echo "<pre>" . print_r($db->readAll(), true) . "</pre>";

$users = array(
    '0' => array('name' => 'aroa', 'password' => '1111'),
    '1' => array('name' => 'ivan', 'password' => '2222'),
    '2' => array('name' => 'pepito', 'password' => '3333'),
    '3' => array('name' => 'menganito', 'password' => '4444'),
);

if (!empty($_POST['userName'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if (isExists($userName)) {
        header("location:content.php");
    }

    if (islogin($users, $userName, $password)) {
        setcookie($userLogin, $userName, time() + 3600);
        header("location:content.php");
    } else {
        header("location:login.php");
    }
}


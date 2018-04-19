<?php
include(dirname(__FILE__) . '/../Cookie.php');

if (!isset($_POST['logOut'])) {
    setcookie("user", "", time()-3600);

    header("location:login.php");
}
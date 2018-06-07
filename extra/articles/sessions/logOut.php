<?php
include dirname(__FILE__) . '/../../../Cookies/Cookie.php';

if (!isset($_POST['logOut'])) {
    Cookie::delete('user');
    header("location:login.php");
}
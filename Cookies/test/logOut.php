<?php
include dirname(__FILE__) . '/../Cookie.php';

if (!isset($_POST['logOut'])) {
    Cookie::delete('user');
    header("location:index.php");
}
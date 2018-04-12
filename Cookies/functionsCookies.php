<?php
$userLogin = 'user';
$userNoLogin = '';

function islogin($users, $userName, $password)
{
    for ($i = 0; $i < count($users); $i++) {
        if ($userName == $users[$i]['name'] && $password == $users[$i]['password']) {
            return true;
        }
    }
    return false;
}

function delete($name)
{
    setcookie($name, "", time() - 3600, "/");
}

function isExists($userName) {
//    if (!isset($_COOKIE[$userName])) {
//        echo "Cookie named '" . $userName . "' is not set!";
//    } else {
//        echo "Cookie '" . $userName . "' is set!<br>";
//    }
    return isset($_COOKIE[$userName]);
}

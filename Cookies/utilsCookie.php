<?php

function isLogin($users, $user, $password)
{
    for ($i = 0; $i < count($users); $i++) {
        if ($user == $users[$i]['Usuario'] && $password == $users[$i]['Clave']) {
            return true;
        }
    }
    return false;
}
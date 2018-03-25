<?php

function separateArrayKeys($values, $separate = ', ')
{
    $keys = array_keys($values);
    $keys = join($separate, $keys);
    return $keys;
}

function separateArrayField($values, $separate = ', ')
{
    $val = [];
    foreach ($values as $value) {
        array_push($val, $value);
    }
    $val = join($separate, $val);
    return $val;
}

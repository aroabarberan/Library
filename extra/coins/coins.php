<?php

// include dirname(__FILE__) . '/../../Files/File.php';


//1 USD TO X
$json_url = "http://www.apilayer.net/api/live?access_key=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$json = file_get_contents($json_url);
$data = json_decode($json, TRUE);


$values = getCoints($data['quotes']);

function getCoints($keysCoins) {
    $coins = [];

    foreach(array_keys($keysCoins) as $coin) {
        $fields = explode('USD', $coin);
        $coins[$fields[1]] = $keysCoins['USD'.$fields[1]];
    }
    return $coins;
}


<?php

require_once 'Coffe.php';

$coffe = 'just';

if ($coffe == 'milk') {
    echo Coffe::withMilk();
} elseif ($coffe == 'chocolate') {
    echo Coffe::withChocolate();
} elseif ($coffe == 'Sugar') {
    echo Coffe::withSugar();
} elseif ($coffe == 'just') {
    echo Coffe::just();
}

switch ($coffe) {
    case 'milk':
        echo Coffe::withMilk();
        break;
    case 'chocolate':
        echo Coffe::withChocolate();    
        break;
    case 'sugar':
        echo Coffe::withSugar();
        break;
    case 'just':
        echo Coffe::just();
        break;
}

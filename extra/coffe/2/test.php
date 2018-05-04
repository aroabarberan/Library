<?php
require_once 'Coffe.php';

$input = 'milk';

$coffe = [
    'milk' => Coffe::withMilk(),
    'chocolate' => Coffe::withChocolate(),
    'sugar' => Coffe::withSugar(),
    'just' => Coffe::just()
];

echo $coffe[$input];
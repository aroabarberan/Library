<?php

require_once 'iCoffe.php';

class Coffe implements iCoffe {
    
    public static function withMilk()
    {
        return "Coffe with milk";
    }

    public static function withChocolate()
    {
        return "Coffe with chocolate";
    }

    public static function withSugar()
    {
        return "Coffe with sugar";
    }

    public static function just()
    {
        return "Coffe just";
    }
}

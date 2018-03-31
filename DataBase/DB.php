<?php

interface DB
{
    function insert($stringFields, $arrayParams);

    function read($idTable, $value);

    function readAll();

    // function update();

    function remove($idTable, $values);

}

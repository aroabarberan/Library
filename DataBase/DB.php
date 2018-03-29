<?php

interface DB
{
    function insert($stringFields, $arrayParams);

    function read($idTable, $id);

    function readAll();

    // function update();

    // function remove();

}

<?php

require_once 'DataBasePDO.php';

$bla = new DataBasePDO();
$bla->setTable('usuarios');
$bla->insert('Usuario, Clave', ['aroa', 'claveAroa']);
// $bla->remove('Usuario', 'aroa');
echo "<pre>" . print_r($bla->readAll(), true) . "</pre>";

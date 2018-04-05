<?php

require_once 'DataBasePDO.php';

$DB = new DataBasePDO();
$DB->setTable('usuarios');
// $DB->insert('Usuario, Clave', ['aroa', 'claveAroa']);
$DB->update(['Usuario', 'Clave'], ['aroa', 'claveModificado']);
// $DB->remove('Usuario', 'aroa');
echo "<pre>" . print_r($DB->readAll(), true) . "</pre>";

<?php

require_once 'DataBasePDO.php';

$db = new DataBasePDO();
$db->setTable('usuarios');
// $db->insert('Usuario, Clave', ['aroa', 'claveAroa']);
$db->update(['Usuario', 'Clave'], ['aroa', 'claveModificado']);
// $db->remove('Usuario', 'aroa');
// $db->read('Familia', $_POST['family']);
echo "<pre>" . print_r($db->readAll(), true) . "</pre>";

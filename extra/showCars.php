<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include dirname(__FILE__) .  '/../DataBase/DataBasePDO.php'; 

$db = new DataBasePDO();
$db->setTable('vehiculos');
echo "<pre>" . print_r($db->readAll(), true) . "</pre>";

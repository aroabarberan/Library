<?php
require_once("DaoArticles.php");


$Id=$_GET['Id'];
$db=conectar("repaso");
$consulta="select Foto from coche where Id=$Id";
$datos=consulta($db,$consulta);

cerrar($db);
$fila=$datos[0];



$imagen=imagecreatefromstring(base64_decode($fila['Foto']));
if ($imagen!=FALSE)
{
    Header('Content-type: image/jpeg');
    imagejpeg($imagen);
}
else
{
    echo "Error al procesar la imagen";
}

<?php

require_once 'DaoArticles.php';
require_once 'classConexion.php';

$dao = new DaoArticulo('repaso');
$dao->listar();

echo '<pre>' . print_r($dao->resul, true) . '</pre>';

//desplegable que carge todas la familias y al selecconar familia muestre todos los productos de esa familia


// sobre el ultimo ejercicio que permita con un check seleccionar tantos productos como quieras
//el boton enviar leva a la pagina en la que aparece los productos que has seleccionado y el importe total

// modificar el anterior para que en el desplegable aparexca un numero del uno al diez
// el despegable muestra un registro por pagina
// si pones 3 muestra los tres primeros de 12 articulos (paginacion)/
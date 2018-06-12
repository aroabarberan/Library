<?php

class Process
{

    public static function nextStore($stores, $cod)
    {
        // $pos = array_search($cod, array_keys($stores));
        // if ($pos == count($stores) - 1) {
        //     reset($stores);
        // }
        // return each($stores);
    }

    public static function updateStore(&$stores, $cod)
    {
        // $stores[$cod] = $stores[$cod] - 1;
        // if ($stores[$cod] == 0) {
        //     unset($stores[$cod]);
        //     $consulta = "delete from stock where unidades=0";
        //     consultaSimple($db, $consulta);
        // }
    }
    public static function getStore($cod)
    {
        // $tiendas = array();
        // $consulta = "select tienda from stock where producto=$cod";
        // $filas = consultaSelect($db, $consulta);
        // foreach ($filas as $fila) {
        //     $tiendas[$fila['tienda']] = $fila['unidades'];
        // }
        // return $tiendas;
    }

    public static function reduceStock($cod, $amount)
    {
        // $tiendas = sacarTiendas($db, $cod);
        // list($tien, $unidades) = each($tiendas); //al sacar en un array primero se comprobara en la central, si no hay suficiente en la tienda 1 y por ultimo en la tienda 2
        // while ($amount > 0) {
        //     $consulta = "update stock set unidades = (unidades-1) where producto=:producto and tienda=:tienda";
        //     $param = array(":producto" => $cod, ":tienda" => $tien);
        //     consultaSimpleSeg($db, $consulta, $param);
        //     actualizaTiendas($db, $tiendas, $tien); //Actualizamos el array
        //     $amount--;
        //     list($tien, $unidades) = siguienteTienda($tiendas, $tien);

        // }
    }
}

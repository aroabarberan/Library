<?php
// include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';

class Process
{

    public static function nextStore($stores, $cod)
    {
        $pos = array_search($cod, array_keys($stores));
        if ($pos == count($stores) - 1) {
            reset($stores);
        }
        return each($stores);
    }

    public static function updateStore(&$stores, $cod)
    {
        $db = new DataBasePDO();
        $stores[$cod] = $stores[$cod] - 1;
        if ($stores[$cod] == 0) {
            unset($stores[$cod]);
            $query = "DELETE FROM stock WHERE unidades=0";
            $db->query($query, $params);
        }
    }
    public static function getStore($cod)
    {
        $db = new DataBasePDO();
        $store = [];
        $rows = $db->query("SELECT tienda FROM stock WHERE producto='$cod'");
        foreach ($rows as $row) {
            $store[$row['tienda']] = $row['unidades'];
        }
        return $store;
    }

    public static function reduceStock($cod, $amount)
    {
        $db = new DataBasePDO();
        $store = getStore($cod);
        list($tien, $unidades) = each($store);
        while ($amount > 0) {
            $query = "UPDATE stock SET unidades = (unidades-1) WHERE producto=:producto AND tienda=:tienda";
            $params= [":producto" => $cod, ":tienda" => $tien];
            $db->query($query, $params);
            updateStore($store, $tien);
            $amount--;
            list($tien, $unidades) = nextStore($store, $tien);

        }
    }
    public static function showError($message)
    {
        echo "<font color=red size=5>$message</font>";
        echo "<a href=index.php>Repetir Pedido</a>";
    }

    public static function amountAvailable($stock, $amounts)
    {
        $i = 0;
        while (($i < count($stock)) && ($stock[$i] >= $amounts[$i])) {
            $i++;
        }
        return (count($stock) == $i);
    }

}

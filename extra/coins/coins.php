<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include dirname(__FILE__) . '/../../DataBase/DataBasePDO.php';
include dirname(__FILE__) . '/../../Images/Image.php';

function getCoins($keysCoins)
{
    $coins = [];

    foreach (array_keys($keysCoins) as $coin) {
        $newCoin = substr($coin, 3, 3);
        $coins[$newCoin] = $keysCoins[$coin];            
    }
    return $coins;
}
$json_url = "http://www.apilayer.net/api/live?access_key=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$json = file_get_contents($json_url);
$data = json_decode($json, true);

$values = getCoins($data['quotes']);

?>
<style>
    #image {
        width: 250px;
        height: 250px;
    }
</style>

<form action="" method="POST" enctype="multipart/form-data">
    <div>
        <label for="coin">Coin</label>
        <select name="coin" id="coin">
            <?php
            foreach ($values as $key => $value) {
                ?> <option value="<?=$key?>"><?=$key?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div>
        <input type="submit" value="send" id="send">
    </div>
</form>

<?php
$db = new DataBasePDO();
$db->setTable('vehiculos');
$results = $db->readAll();

if (!isset($_POST['coin'])) {
    foreach ($results as $key => $result) {
        $string = base64_decode($results[$key]['Imagen']);
        $image = Image::createImageFromString($string);
        ?>
        <img src='<?=$image->getSrc();?>' id="image"> 
        <?php
        echo $result['PVP'];
    }
} else {
    foreach ($results as $key => $result) {
        $string = base64_decode($results[$key]['Imagen']);
        $image = Image::createImageFromString($string);
        ?>
        <img src='<?=$image->getSrc();?>' id="image"> 
        <?php
        echo $result['PVP'] * $values[$_POST['coin']];
    }
}

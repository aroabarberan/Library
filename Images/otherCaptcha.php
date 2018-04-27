<?php

require_once 'Image.php';

ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<table>
    <tr>
        <td>Numeros</td>
        <td>A</td>
        <td>B</td>
        <td>C</td>
        <td>D</td>
        <td>E</td>
    </tr>
    <?php
$letter = "ABCDE";
$row = "";
$col = "";

for ($i = 0; $i < 5; $i++): ?>
        <tr>
            <td> <?=$i?></td>
            <?php
                $row .= rand(0, 4);
                $col .= $letter[rand(0, strlen($letter) - 1)];

                for ($j = 0; $j < 5; $j++):
                    $image[$i] = new Image(100, 75);
                    $image[$i]->fill($image[$i]->getColorRandom());
                    $letters = $image[$i]->generateLettersRandom(1);

                    $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorRandom(), -40);
                    $image[$i]->paintLineRandom(5, 100, 75, $image[$i]->getColorRandom());
            ?>

	            <td><img src="<?=$image[$i]->getSrc();?>" alt=""></td>
	            <?php endfor;?>
        </tr>
    <?php endfor;?>
</table>

<?php for ($k = 0; $k < 5; $k++):
    if ($col[$k] == $letter[$j]) {
        //     if ($row == $i) {
        //         echo $letters;
        //         $captcha =  $letters;
        //     }
    }
endfor?>

<form action="" method="post">
    <label for="resultCaptcha"><?=$row . $col?>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </label>
    <input type="hidden" name=letters value="<?=$captcha?>">
    <input type="submit" name="send" id="send" value="Send">
</form>

<?php

if (!isset($_POST['send'])) {
    return;
}

if ($_POST['letters'] == $_POST['resultCaptcha']) {
    echo "Coincide";
} else {
    echo "No coincide";
}
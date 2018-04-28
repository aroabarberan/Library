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
        <!-- <td>D</td>
        <td>E</td> -->
    </tr>
    <?php
    
    $letter = "ABC";
    $rowNumber = "";
    $columLetter = "";
    $captcha = "";

    for ($i = 0; $i < 3; $i++): ?>
        <tr>
            <td> <?=$i?></td>
            <?php
                $rowNumber .= rand(0, 2);            
                $columLetter .= $letter[rand(0, strlen($letter) - 1)];

                for ($j = 0; $j < 3; $j++):
                    $image[$i] = new Image(100, 75);
                    // $image[$i]->fill($image[$i]->getColorRandom());
                    $image[$i]->fill($image[$i]->getColorBlack());
                    $letters = $image[$i]->generateLettersRandom(1);

                    // $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorRandom(), -40);
                    $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorWhite(), -40);
                    // $image[$i]->paintLineRandom(5, 100, 75, $image[$i]->getColorRandom());
                    
                    for ($k = 0; $k < 5; $k++) {
                        if ($rowNumber[$i] == $k) {
                            if ($columLetter[$i] == $letter[$j]) {
                                echo $letters;
                                $captcha .=  $letters;
                            }
                        }
                        
                    }
            ?>
	        <td><img src="<?=$image[$i]->getSrc();?>" alt=""></td>
	        <?php endfor;?>
        </tr>
    <?php endfor;?>
</table>

<form action="" method="post">
    <label for="resultCaptcha"><?=$rowNumber . "<br>" . $columLetter?>
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
<?php
require_once 'Image.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<table>
    <tr>
        <td>&nbsp</td>
        <?php
        $letter = "ABCDE";
        $length = strlen($letter);
        for ($i = 0; $i < $length; $i++): ?>
            <td> <?=$i?></td>   
        <?php endfor;?>
    </tr>
    <?php
    
    $rowNumber = "";
    $columLetter = "";
    $captcha = "";

    for ($i = 0; $i < $length; $i++): ?>
        <tr>
            <td> <?=$letter[$i]?></td>
            <?php
                $rowNumber .= rand(0, 2);            
                $columLetter .= $letter[rand(0, strlen($letter) - 1)];

                for ($j = 0; $j < $length; $j++):
                    $image[$i] = new Image(100, 75);
                    $image[$i]->fill($image[$i]->getColorBlack());

                    $letters = $image[$i]->generateLettersRandom(1);
                    $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorWhite(), -40);
                    $image[$i]->paintLineRandom(5, 100, 75, $image[$i]->getColorYellow());
                    
                    $panel[$j][$letter[$i]] = $letters;
            ?>
	        <td><img src="<?=$image[$i]->getSrc();?>" alt=""></td>
	        <?php endfor;?>
        </tr>
    <?php endfor;?>
    <?php

    for ($i = 0; $i < count($panel); $i++):
        $captcha .= $panel[$rowNumber[$i]][$columLetter[$i]];       
    endfor;
    echo $captcha;
    ?>
</table>

<form action="" method="post">
    <label for="resultCaptcha"><?=$rowNumber . "<br>" . $columLetter?>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </label>
    <input type="hidden" name="letters" value="<?=$captcha?>">
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
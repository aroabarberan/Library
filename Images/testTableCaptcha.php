<?php
require_once 'Image.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<table border=2>
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
        $col = $letter[rand(0, strlen($letter) -1)];
        $row = rand(0, 4);

        for ($i = 0; $i < 5; $i++): ?>
        <tr>
            <td> <?=$i?></td>
            <?php 
                for ($j = 0; $j < 5; $j++):
                    $image[$i] = new Image(100, 75);
                    $image[$i]->fill($image[$i]->getColorRandom());
                    $letters = $image[$i]->generateLettersRandom(6);
            
                    $image[$i]->writeTextInImage($letters, 20, 35, $image[$i]->getColorRandom(), -40);
                    $image[$i]->paintLineRandom(5, 100, 75, $image[$i]->getColorRandom());
                    
                    if ($col == $letter[$j]) {
                        if ($row == $i) {
                            echo $letters;
                            $captcha =  $letters;              
                        }
                    }
            ?>            
            <td><img src="<?=$image[$i]->getSrc(); ?>" alt=""></td>
            <?php endfor; ?>
        </tr>
    <?php endfor;?>
</table>

<form action="" method="post">
    <label for="resultCaptcha"><?= $row . $col ?>
        <input type="text" name="resultCaptcha" id="resultCaptcha">
    </label>
    <input type="hidden" name=letters value="<?=  $captcha ?>">    
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
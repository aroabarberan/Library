<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL|E_NOTICE);

require_once 'Image.php';

$width = 520;
$height = 360;

$widthSquare = $width /5;
$heighSquare = $height /5;

$image = new Image($width, $height);
$image->fill($image->getColorBlack());
$image->writeTextInImage($image->generateLettersRandom(6), 250, 140, $image->getColorWhite());
$image->paintAsteriskInImage($width, $height, $image->getColorGreen());
$image->paintTableWithLines(5, $width, $height, $image->getColorGreen());
// $image->generateCaptcha(5, $widthSquare, $heighSquare, $white, $image->getColorRandom());

// $image = Image::createJpeg("sony.jpg");


?>
<img src="<?= $image->getSrc(); ?>" alt="">
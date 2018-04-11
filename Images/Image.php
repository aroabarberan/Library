<?php

class Image
{
    private $image;

    public function __construct($width, $height)
    {
        $this->image = imagecreate($width, $height);
    }

    public static function createJpeg($path)
    {
        return imagecreatefromjpeg($path);
    }

    public static function createImageFromString($string) {
        $width = getimagesizefromstring($string)[0];
        $height = getimagesizefromstring($string)[1];
        
        $img =  new Image($width, $height);
        $img->image = imagecreatefromstring($string);
        return $img;
    }

    public function fill($color)
    {
        imageFill($this->image, 0, 0, $color);
    }

    public function writeTextInImage($text, $x, $y, $fontColor, $angle = 0.0, $size = 12.0, $fontFile = './arial.ttf')
    {
        imagettftext($this->image, $size, $angle, $x, $y, $fontColor, $fontFile, $text);
    }

    public function paintLineInImage($initX, $initY, $endX, $endY, $color)
    {
        imageline($this->image, $initX, $initY, $endX, $endY, $color);
    }

    public function paintLineRandom($numberLines, $limitWidth, $limitHeight, $color)
    {
        for ($i = 0; $i < $numberLines; $i++) {
            $this->paintLineInImage(rand(0, $limitWidth), rand(0, $limitHeight), rand(0, $limitWidth), rand(0, $limitHeight), $color);
        }
    }

    public function paintAsteriskInImage($limitWidth, $limitHeight, $color)
    {
        $this->paintLineInImage(0, 0, $limitWidth, $limitHeight, $color);
        $this->paintLineInImage(0, $limitHeight / 2, $limitWidth, $limitHeight / 2, $color);
        $this->paintLineInImage(0, $limitHeight, $limitWidth, 0, $color);
        $this->paintLineInImage($limitWidth / 2, 0, $limitWidth / 2, $limitHeight, $color);

    }

    public function paintTableWithLines($numberLines, $limitWidth, $limitHeight, $color)
    {
        for ($i = 1; $i < $numberLines; $i++) {
            $this->paintLineInImage(0, $limitHeight / $numberLines * $i, $limitWidth, $limitHeight / $numberLines * $i, $color);
            $this->paintLineInImage($limitWidth / $numberLines * $i, 0, $limitWidth / $numberLines * $i, $limitHeight, $color);
        }
    }

    public function generateCaptcha($numberLines, $limitWidth, $limitHeight, $colorLetters, $colorLines,  $angle = 0.0)
    {
        for ($i = 0; $i <= $numberLines; $i++) {
            for ($j = 0; $j < $numberLines; $j++) {
                $this->writeTextInImage($this->generateLettersRandom(6), $limitWidth * $i, $limitHeight * $j, $colorLetters, $angle);
                $this->paintLineRandom(5, $limitWidth * $i, $limitHeight * $i, $colorLines);
            }
        }
    }

    public function generateLettersRandom($numberLetters)
    {
        $consonants = 'ABCDEFGHIJKLMMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $captcha = '';
        for ($i = 0; $i < $numberLetters; $i++) {
            $captcha .= $consonants[rand(0, strlen($consonants) - 1)];
        }
        return $captcha;
    }

    public function getSrc()
    {
        ob_start();
        imagejpeg($this->image);
        $image = ob_get_clean();
        return "data:image/jpeg;base64," . base64_encode($image);
    }

    public function getColorRandom()
    {
        $colors = [
            $this->getColorBlack(),
            $this->getColorRed(),
            $this->getColorYellow(),
            $this->getColorGreen(),
            $this->getColorGrey(),
            $this->getColorWhite(),
        ];

        return $colors[rand(0, count($colors) - 1)];
    }

    public function getColorRed()
    {
        return imageColorAllocate($this->image, 255, 0, 0);
    }

    public function getColorBlack()
    {
        return imageColorAllocate($this->image, 0, 0, 0);
    }

    public function getColorYellow()
    {
        return imageColorAllocate($this->image, 255, 255, 0);
    }

    public function getColorWhite()
    {
        return imageColorAllocate($this->image, 255, 255, 255);
    }

    public function getColorGreen()
    {
        return imageColorAllocate($this->image, 0, 255, 0);
    }

    public function getColorGrey()
    {
        return imageColorAllocate($this->image, 128, 128, 128);
    }
}

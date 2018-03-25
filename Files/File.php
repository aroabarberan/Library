<?php


class File
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public static function file($file)
    {
        return new File($file);
    }

    public static function createFile($file)
    {
        return fopen($file, 'w+');
    }

    public static function readFile($file)
    {
        $f = fopen($file, 'r');
        $content = [];
        while (!feof($f)) {
            $line = trim(fgets($f));
            if ($line != null) {
                $content[] = $line;
            }
        }
        return $content;
    }

    public static function readFileFirstLine($file)
    {
        return File::readFile($file)[0];
    }

    public static function readFileLastLine($file)
    {
        $content = File::readFile($file);
        return $content[count($content) - 1];
    }
    
    public static function readFileEnv($txt)
    {
        $file = fopen($txt, 'r');
        $datas = [];
        while (!feof($file)) {
            $line = fgets($file);
            $fields = explode('=', trim($line));
            $datas[$fields[0]] = $fields[1];
        }
        fclose($file);
        return $datas;
    }

    public static function writeLineFile($file, $content)
    {
        $f = fopen($file, "a");
        fwrite($f, $content . "\n");
        fclose($f);
    }

    public static function writeArrayFile($file, $contents, $separator = ' ')
    {
        $f = fopen($file, "a");
        foreach ($contents as $content) {
            fwrite($f, $content . $separator);
        }
        fwrite($f, "\r\n");

        fclose($f);
    }

    public static function copyFile($fileToCopy)
    {
        $contents = File::readFile($fileToCopy);
        foreach ($contents as $content) {
            File::writeLineFile('fileCopy.txt', $content);
        }
    }

    public static function countWordsFile($file, $word)
    {
        $f = fopen($file, "r");
        $cont = 0;

        while (!feof($f)) {
            $line = fgets($f);
            $campo = explode(" ", rtrim($line));

            foreach ($campo as $valor) {
                if (!strcasecmp($word, $valor)) {
                    $cont++;
                }
            }
        }
        fclose($f);
        return $cont;
    }

    public static function countAllLettersFile($contentFile)
    {
        $letters = [];
        $counts = [];
        $c = 0;
        $con = 0;
        for ($i = 0; $i < count($contentFile); $i++) {
            for ($j = 0; $j < strlen($contentFile[$i]); $j++) {
                if (!in_array(strtolower($contentFile[$i][$j]), $letters) && $contentFile[$i][$j] != '.' && $contentFile[$i][$j] != ' ') {
                    $letters[] = strtolower($contentFile[$i][$j]);
                    $counts[$letters[$c]] = 0;
                    $c++;
                    $con++;
                } else {
                    if ($contentFile[$i][$j] != ' ') $con++;
                }
            }
        }
        foreach ($letters as $letter) {
            for ($i = 0; $i < count($contentFile); $i++) {
                for ($j = 0; $j < strlen($contentFile[$i]); $j++) {
                    if ($letter == strtolower($contentFile[$i][$j])) {
                        $counts[$letter] += 1;
                    }

                }
            }
        }
        $counts[] = $con;
        return $counts;
    }

    private static function invest($word)
    {
        $temp = "";
        for ($i = strlen($word) - 1; $i >= 0; $i--) {
            $temp .= $word[$i];
        }
        return $temp;
    }

    public static function investFile($file, $fileToInvest)
    {
        $f = fopen($file, "r");
        $fileCopy = fopen($fileToInvest, "w");

        while (!feof($f)) {
            $line = fgets($f);
            $fields = explode(" ", $line);

            foreach ($fields as $field) {
                fwrite($fileCopy, File::invest(trim($field)) . ' ');
            }
            fwrite($fileCopy, "\r\n");
        }
        fclose($f);
    }

    public static function deleteFile($file)
    {
        unlink($file);
    }

    public static function searchPerson($file, $name, $lastName)
    {
        {
            $persons = [];
            $f = fopen($file, "r");

            while (!feof($f)) {
                $file = fgets($f);
                $fields = explode(' ', $file);
                $persons[] = [
                    'id' => $fields[3],
                    'name' => $fields[0],
                    'lastName1' => $fields[1],
                    'lastName2' => $fields[2],
                ];
            }
            fclose($f);
            foreach ($persons as $person) {
                if ($person['name'] == $name && $person['lastName1'] == $lastName) {
                    return $person;
                }
            }
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

}
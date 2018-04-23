<?php

include(dirname(__FILE__) . '/../File.php'); 
include(dirname(__FILE__) . '/../../Dates/Date.php'); 
include(dirname(__FILE__) . '/../../Dates/FamilyDate.php'); 

$alumns = [];
$alumnsData = fopen('../txt/DatosAlumnos.txt', 'r');
$alumnsAge = fopen('../txt/edades.txt', 'r');

while (!feof($alumnsData)) {
    $lineAlumnsData = fgets($alumnsData);
    $lineAlumnsAge = fgets($alumnsAge);

    $fieldsAlumnsData = explode(' ', $lineAlumnsData);
    $fieldsAlumnsAge = explode(' ', $lineAlumnsAge);

    $alumns[$fieldsAlumnsData[0]] = [
        'id' => $fieldsAlumnsData[0],
        'name' => $fieldsAlumnsData[3],
        'lastName' => $fieldsAlumnsData[2] . ' ' . $fieldsAlumnsData[1],
        'age' => FamilyDate::separateStringDateToObjectDate(trim($fieldsAlumnsAge[1]))
    ];
}
fclose($alumnsData);
//echo "<pre>" . print_r($alumns, true) . "</pre>";

function sortArrayByAField($arrayToSort, $field, $inverse = false)
{
    $toSorts = [];
    $newRow = [];
    foreach ($arrayToSort as $row) {
        $toSorts[] = $row[$field];
        $newRow[] = $row;
    }
    if ($inverse) arsort($toSorts);
    asort($toSorts);

    $alumnsSort = [];

    foreach ($toSorts as $key => $sort) {
        $alumnsSort[] = $newRow[$key];
    }
    return $alumnsSort;
}

$sortByAge = sortArrayByAField($alumns, 'age');
echo "<pre>" . print_r($sortByAge, true) . "</pre>";

echo 'El alumno mas viejo es: ' . $sortByAge[0]['name']. '<br>';
echo 'El alumno mas joven es: ' . $sortByAge[count($sortByAge) -1]['name']. '<br>';

<?php


require_once '../File.php';

$contents = File::readFile('../txt/frecuencia.txt');
$counts = File::countAllLettersFile($contents);

echo "<pre>" . print_r($counts, true) . "</pre>";
?>

<table border="2px">
    <tr>
        <th>Letter</th>
        <th>%</th>
    </tr>
    <?php
    $cont = $counts[0] -1;

    foreach ($counts as $key => $count):
        ?>
        <tr>
            <?php
            echo '<td>' . $key . '</td>';
            echo '<td>' . number_format((($count * 100) / $cont), 2) . '%</td>';
            ?>
        </tr>
        <?php
    endforeach;
    ?>
</table>

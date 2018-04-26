<?php

const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = 'root';
const DATABASE = 'servidor';

$init = 1;
$link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
$query = "SELECT * FROM articulos";
$result = mysqli_query($link, $query);
$articles = [];

while ($row = mysqli_fetch_array($result)) {
    $articles[] = [
        'Id' => $row['Id'],
        'Nombre' => $row['Nombre'],
        'Marca' => $row['Marca'],
        'Modelo' => $row['Modelo'],
        'Precio' => $row['Precio'],
        'Familia' => $row['Familia']
    ];
}

$size = count($articles) - 1;
$articlesPerPage = 5;
$numberLinks = round($size / $articlesPerPage) -1;
$page = 1;

function showArticles($articlesPerPage, $articles, $page)
{
    $init = $articlesPerPage * $page;
    for ($i = $init; $i < $init + 5; $i++): ?>
        <tr>
            <td><?php echo $articles[$i]['Id'] ?></td>
            <td><?php echo $articles[$i]['Nombre'] ?></td>
            <td><?php echo $articles[$i]['Marca'] ?></td>
            <td><?php echo $articles[$i]['Modelo'] ?></td>
            <td><?php echo $articles[$i]['Precio'] ?></td>
            <td><?php echo $articles[$i]['Familia'] ?></td>
        </tr>
    <?php endfor;
}

?>
<style>
    table {
        border: 2px solid #000;
        border-radius: 4px;
        border-collapse: collapse;
    }

    th {
        padding: 15px;
        border: 1px solid #000;
    }

    tr, td {
        padding: 10px;
    }

</style>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Model</th>
        <th>Precio</th>
        <th>Familia</th>
    </tr>
    <?php showArticles($articlesPerPage, $articles, $_GET['init']); ?>
</table><br><br>


<?php for ($i = 0; $i < $numberLinks; $i++): ?>
    <a href="pagination.php?init=<?php echo $i + 1?>"> <?php echo $i +1 ?></a>
<?php endfor; ?>


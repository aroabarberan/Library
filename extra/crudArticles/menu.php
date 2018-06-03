<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

include dirname(__FILE__) . '/Article.php';
include dirname(__FILE__) . '/DaoArticle.php';
include dirname(__FILE__) . '/../../Images/Image.php';
?>
<style>
img {
    width:100px;
    height:100px;
}
</style>
<h1>Articles</h1>
<ol>
    <li><a href='menuPrincipal.php?op=1'>Listar en una tabla HTML todos los Articulos</a></li>
    <li><a href='menuPrincipal.php?op=2'>Buscar Articulo por id y mostrar todos sus datos</a></li>
    <li><a href='menuPrincipal.php?op=3'>Borrar un articulo introduciendo su Id</a></li>
    <li><a href='menuPrincipal.php?op=4'>Editar los datos del articulo</a></li>
    <li><a href='menuPrincipal.php?op=5'>Insertar un nuevo articulo</a></li>
</ol>

<?php
if (isset($_GET['op'])) {
    $op = $_GET['op'];
    switch ($op) {
        case 1:
            $articles = DaoArticles::readAll();
            ?>
        <h1>Todos los articulos</h1>
        <table border='2'>
            <tr>
                <td>id</td>
                <td>nombre</td>
                <td>marca</td>
                <td>modelo</td>
                <td>precio</td>
                <td>familia</td>
                <td>Imagen</td>
                <td>tipo</td>
            </tr>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?=$article->getNif()?></td>
                    <td><?=$article->getNombre()?></td>
                    <td><?=$article->getApellido1()?></td>
                    <td><?=$article->getApellido2()?></td>
                    <?php
                    $string = base64_decode($article->getImagen());
                    $image = Image::modeloeImageFromString($string);
                    $image->writeTextInImage('STOCK', 50, 50, $image->getColorRed(), -40, 50);
                    ?>
                    <td><img src='<?=$image->getSrc();?>'></td>
                    <td><?=$article->getTipo()?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <?php
        break;

        case 2:
            ?>
        <h1>Mostrar informacion de un articulo</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <label for=id>id</label><input type=text name=id>
                <input type=submit name=send  value=send>
        </form>
        <?php
        if (isset($_POST['send'])):
            $id = $_POST['id'];
            $article = DaoArticles::read($id);
        ?>
            <p>Nif <?=$article->getNif()?></p>
            <p>Nombre <?=$article->getNombre()?></p>
            <p>Apellido1 <?=$article->getApellido1()?></p>
            <p>Apellido2 <?=$article->getApellido2()?></p>
            <p>Imagen <img src='data:image/jpeg;base64, <?=$article->getImagen()?>'></p>
            <p>tipo <?=$article->getTipo()?></p>

        <?php
        endif;
        break;

        case 3:
            ?>
        <h1>Eliminar cliente</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <label for=id>Nif</label><input type=text name=id>
            <input type=submit name=send  value=Send>
        </form>
        <?php
if (isset($_POST['send'])) {
                $id = $_POST['id'];
                DaoArticles::delete("$id");
            }
            break;

        case 4:
            ?>
        <h1>Actualizar cliente</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <div>
                <label for=id>Nif </label>
                <input type=text name=id>
            </div>
            <div>
                <input type=submit name=send  value=Enviar>
            </div>
        </form>
        <?php
if (isset($_POST['send'])) {
                $id = $_POST['id'];
                $article = DaoArticles::read($id);
                ?>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <div>
                <label for=id>Nif: </label>
                <input type=text name=id value=<?=$article->getNif();?>>
            </div>
            <div>
                <label for=nombre>Nombre: </label>
                <input type=text name=nombre value=<?=$article->getNombre();?>>
            </div>
            <div>
                <label for=apellido1>Apellido1: </label>
                <input type=text name=apellido1 value=<?=$article->getApellido1();?>>
            </div>
            <div>
                <label for=apellido2>Apellido2: </label>
                <input type=text name=apellido2 value=<?=$article->getApellido2();?>>
            </div>
            <div>
                <label for=foto>foto: </label>
                <img src='data:image/jpeg;base64, <?=$article->getImagen()?>'>
                <input type="file" name=foto>
            </div>
            <div>
                <label for=tipo>Tipo: </label>
                <input type=text name=tipo value=<?=$article->getTipo()?>>
            </div>
            <div>
                <input type=submit name=actualizar  value=Actualizar>
            </div>
        </form>
        <?php
if (isset($_POST['actualizar'])) {
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $apellido1 = $_POST['apellido1'];
                    $apellido2 = $_POST['apellido2'];
                    $tipo = $_POST['tipo'];

                    $rutaTemp = $_FILES['foto']['tmp_name'];
                    $campos = explode(".", $_FILES['foto']['name']);
                    $tipoImagen = $campos[1];
                    $tam = $_FILES['foto']['size'];

                    $imagen = base64_encode(file_get_contents($rutaTemp));
                    $article = new Client("$id", "$nombre", "$apellido1", "$apellido2", "$imagen", "$tipo");
                    DaoArticles::update($article);
                }
            }
            break;

        case 5:
            ?>
        <h1>Insertar cliente</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <div>
                <label for=id>Nif</label>
                <input type=text name=id>
            </div>
            <div>
                <label for=nombre>Nombre</label>
                <input type=text name=nombre>
            </div>
            <div>
                <label for=apellido1>Apellido1</label>
                <input type=text name=apellido1>
            </div>
            <div>
                <label for=apellido2>Apellido2</label>
                <input type=text name=apellido2>
            </div>
            <div>
                <label for=foto>Foto</label>
                <input type=file name=foto>
            </div>
            <div>
                <input type=submit name=send  value=Enviar>
            </div>
        </form>

        <?php
if (isset($_POST['send'])) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $apellido1 = $_POST['apellido1'];
                $apellido2 = $_POST['apellido2'];

                $rutaTemp = $_FILES['foto']['tmp_name'];
                $campos = explode(".", $_FILES['foto']['name']);
                $tipo = $campos[1];
                $tam = $_FILES['foto']['size'];

                $imagen = base64_encode(file_get_contents($rutaTemp));

                $article = new Client("$id", "$nombre", "$apellido1", "$apellido2", "$imagen", "$tipo");
                DaoArticles::create($article);
            }
            break;
        default:
            echo "Seleccione una opción del menú";
            break;
    }
}
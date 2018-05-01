<?php
require_once "Client.php";
require_once "DaoClient.php";
// require_once "../image/Image.php";

ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<style>
img {
    width:100px;
    height:100px;
}
</style>
<h1>Clientes</h1>
<ol>
    <li><a href='menuPrincipal.php?op=1'>Listar en una tabla HTML todos los Clientes</a></li>
    <li><a href='menuPrincipal.php?op=2'>Buscar Cliente por nif y mostrar todos sus datos</a></li>
    <li><a href='menuPrincipal.php?op=3'>Borrar un cliente introduciendo su DNI</a></li>
    <li><a href='menuPrincipal.php?op=4'>Editar los datos del cliente</a></li>
    <li><a href='menuPrincipal.php?op=5'>Insertar un nuevo cliente</a></li>
</ol>

<?php
if (isset($_GET['op'])) {
    $op = $_GET['op'];
    switch ($op) {
        case 1:
        $clients = DaoClient::readAll();
?>
        <h1>Todos los clientes</h1>
        <table border='2'>
            <tr>
                <td>nif</td>
                <td>nombre</td>
                <td>apellido1</td>
                <td>apellido2</td>
                <td>Imagen</td>
                <td>tipo</td>
            </tr>
            <?php foreach ($clients as $client) { ?>
                <tr>
                    <td><?= $client->getNif() ?></td>
                    <td><?= $client->getNombre() ?></td>
                    <td><?= $client->getApellido1() ?></td>
                    <td><?= $client->getApellido2() ?></td>
                    <?php
                    $string = base64_decode($client->getImagen());
                    $image = Image::createImageFromString($string);
                    $image->writeTextInImage('STOCK', 50, 50, $image->getColorRed(), -40, 50);
                    ?>
                    <td><img src='<?= $image->getSrc(); ?>'></td>
                    <td><?= $client->getTipo() ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php
            break;

        case 2:
        ?>
        <h1>Mostrar informacion de un cliente</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <label for=nif>nif</label><input type=text name=nif>
                <input type=submit name=send  value=send>
        </form>
        <?php
            if (isset($_POST['send'])) {
                $nif = $_POST['nif'];
                $client = DaoClient::read($nif);
        ?>   
            <p>Nif <?= $client->getNif() ?></p>
            <p>Nombre <?= $client->getNombre() ?></p>
            <p>Apellido1 <?= $client->getApellido1() ?></p>
            <p>Apellido2 <?= $client->getApellido2() ?></p>
            <p>Imagen <img src='data:image/jpeg;base64, <?= $client->getImagen() ?>'></p>
            <p>tipo <?= $client->getTipo() ?></p>
        
        <?php
            }
        break;

        case 3:
        ?>
        <h1>Eliminar cliente</h1>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <label for=nif>Nif</label><input type=text name=nif>
            <input type=submit name=send  value=Send>
        </form>
        <?php
            if (isset($_POST['send'])) {
                $nif = $_POST['nif'];
                DaoClient::delete("$nif");
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
                $nif = $_POST['id'];
                $client = DaoClient::read($nif);
        ?>
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <div>
                <label for=nif>Nif: </label>
                <input type=text name=nif value=<?= $client->getNif(); ?>>            
            </div>
            <div>
                <label for=nombre>Nombre: </label>
                <input type=text name=nombre value=<?= $client->getNombre(); ?>>            
            </div>
            <div>
                <label for=apellido1>Apellido1: </label>
                <input type=text name=apellido1 value=<?= $client->getApellido1(); ?>>            
            </div>
            <div>
                <label for=apellido2>Apellido2: </label>
                <input type=text name=apellido2 value=<?= $client->getApellido2(); ?>>       
            </div>
            <div>
                <label for=foto>foto: </label>
                <img src='data:image/jpeg;base64, <?= $client->getImagen() ?>'>
                <input type="file" name=foto>        
            </div>
            <div>
                <label for=tipo>Tipo: </label>
                <input type=text name=tipo value=<?= $client->getTipo() ?>>            
            </div>
            <div>
                <input type=submit name=actualizar  value=Actualizar>    
            </div>
        </form>
        <?php
            if (isset($_POST['actualizar'])) {
                $nif = $_POST['nif'];
                $nombre = $_POST['nombre'];
                $apellido1 = $_POST['apellido1'];
                $apellido2 = $_POST['apellido2'];
                $tipo = $_POST['tipo'];

                $rutaTemp = $_FILES['foto']['tmp_name'];
                $campos = explode(".", $_FILES['foto']['name']);
                $tipoImagen = $campos[1];
                $tam = $_FILES['foto']['size'];

                $imagen = base64_encode(file_get_contents($rutaTemp));
                $client = new Client("$nif", "$nombre", "$apellido1", "$apellido2", "$imagen", "$tipo");
                DaoClient::update($client);
            }
        }
        break;

        case 5:
        ?>
        <h1>Insertar cliente</h1>        
        <form name=f1 method=post action=#  enctype="multipart/form-data" >
            <div>
                <label for=nif>Nif</label>
                <input type=text name=nif>
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
                $nif = $_POST['nif'];
                $nombre = $_POST['nombre'];
                $apellido1 = $_POST['apellido1'];
                $apellido2 = $_POST['apellido2'];

                $rutaTemp = $_FILES['foto']['tmp_name'];
                $campos = explode(".", $_FILES['foto']['name']);
                $tipo = $campos[1];
                $tam = $_FILES['foto']['size'];

                $imagen = base64_encode(file_get_contents($rutaTemp));

                $client = new Client("$nif", "$nombre", "$apellido1", "$apellido2", "$imagen", "$tipo");
                DaoClient::create($client);
            }          
            break;
        default:
            echo "Seleccione una opción del menú";
            break;
    }
}
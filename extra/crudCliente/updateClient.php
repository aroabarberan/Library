<?php
require_once 'Client.php';
require_once 'DaoClient.php';
?>

<h1>Actualizar cliente</h1>
            <form name=f1 method=post action=#  enctype="multipart/form-data" >
                <label for=NIF>NIF</label><input type=text name=NIF>
                <input type=submit name=Enviar  value=Enviar>
            </form>
            <?php
            if (isset($_POST['Enviar'])) {
                $NIF = $_POST['NIF'];

                $resultCliente = DaoFamilia::read($NIF);
            ?>
                <form name=f1 method=post action=#  enctype="multipart/form-data" >
                    <label for=NIF>NIF</label><input type=text name=NIF value=<?php echo $resultCliente->getId() ?>>
                    <label for=Nombre>Nombre</label><input type=text name=Nombre value=<?php echo $resultCliente->getNombre() ?>>
                    <label for=Apellido1>Apellido1</label><input type=text name=Apellido1 value=<?php echo $resultCliente->getImagen() ?>>
                    <label for=Apellido2>Apellido2</label><input type=text name=Apellido2 value=<?php echo $resultCliente->getApellido2() ?>>
                    <?php  echo "Imagen: <img src='data:image/jpeg;base64," . base64_encode($resultCliente->getImagen()) . "'><br>";?>
                    <label for=Tipo>Tipo</label><input type=file name=Tipo value=<?php echo $resultCliente->getTipo() ?>>
                    <input type=submit name=Actualizar  value=Actualizar>
                </form>
            <?php
                if (isset($_POST['Actualizar'])) {
                    echo "BLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa";

                    $NIF = $_POST['NIF'];
                    $Nombre = $_POST['Nombre'];
                    $Apellido1 = $_POST['Apellido1'];
                    $Apellido2 = $_POST['Apellido2'];
                    $Tipo = $_POST['Tipo'];

                    $rutaTemp = $_FILES['Foto']['tmp_name'];
                    $campos = explode(".", $_FILES['Foto']['name']);
                    $tipo = $campos[1];
                    $tam = $_FILES['Foto']['size'];

                    $imagen = base64_encode(file_get_contents($rutaTemp));
                    echo $NIF;
                    echo $Nombre;
                    echo $Apellido1;
                    echo $Apellido2;
                    echo $Imagen;                                                            
                    $newCliente = new Familia2("$NIF", "$Nombre", "$Apellido1", "$Apellido2", "$imagen", "$tipo");
                    $create = DaoFamilia::update($newCliente);
                    
                }
            }
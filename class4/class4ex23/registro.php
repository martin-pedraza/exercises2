<?php
    include ("Usuario.php");

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    $usuario = new Usuario($nombre, $clave, $email, Usuario::ObtenerId(), date("j-n-Y"));

    $destino = "Usuario/Fotos/".$_FILES["archivo"]["name"];
    $mensaje = move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);

    echo "Se pudo guardar la imagen? " . ($mensaje?"si":"no");
?>
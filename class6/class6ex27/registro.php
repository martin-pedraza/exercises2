<?php
    require("Usuario.php");

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $localidad = $_POST["localidad"];

    $usuario = new Usuario($nombre, $apellido, $clave, $mail, $localidad);
    echo "Se guardo el usuario? " . (Usuario::GuardarUsuario($usuario)?"si":"no");
?>
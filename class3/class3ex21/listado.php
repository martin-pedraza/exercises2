<?php
    include("Usuario.php");

    // $nombre = $_POST['nombre'];
    // $clave = $_POST['clave'];
    // $email = $_POST['email'];

    // $usuario = new Usuario($nombre, $clave, $email);
    // echo "Se pudo guardar el usuario: " . (Usuario::DarAltaUsuario($usuario)?"si":"no");

    $arrayUsuarios = Usuario::RecuperarUsuarios();
    $cadenaHTML = Usuario::CrearListadoUsuarios($arrayUsuarios);
    echo $cadenaHTML;
?>
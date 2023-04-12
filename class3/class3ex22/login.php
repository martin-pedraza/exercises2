<?php
    include("Usuario.php");

    $email = $_POST['email'];
    $clave = $_POST['clave'];

    $usuario = new Usuario($email, $clave);
    //echo "Se pudo guardar el usuario: " . (Usuario::DarAltaUsuario($usuario)?"si":"no");

    $arrayUsuarios = Usuario::RecuperarUsuarios();
    echo Usuario::VerificarUsuario($arrayUsuarios, $usuario);
?>
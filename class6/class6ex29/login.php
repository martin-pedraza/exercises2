<?php
    require("Usuario.php");

    $mail = $_POST["mail"];
    $clave = $_POST["clave"];

    $usuario = new Usuario($mail, $clave);
    $existe = Usuario::TraerUnUsuarioPorMail($mail);
    if ($existe) {
        if ($existe->clave == $clave) {
            echo "Verificado";
        }else {
            echo "Error en los datos";
        }
    }else {
        echo "Usuario no registrado";
    }
?>
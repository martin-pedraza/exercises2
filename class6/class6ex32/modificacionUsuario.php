<?php
    include("Usuario.php");

    $nombre = $_POST["nombre"];
    $claveNueva = $_POST["claveNueva"];
    $claveVieja = $_POST["claveVieja"];
    $mail = $_POST["mail"];

    $cambioClave = false;
    $usuarioDB = Usuario::TraerUnUsuarioPorMail($mail);
    if ($usuarioDB) {
        if ($usuarioDB->__get("clave") == $claveVieja) {
            $usuarioDB->__set("clave", $claveNueva);
            $cambioClave = $usuarioDB->ModificarUsuario();
        }
    }
    echo "Se cambio la clave? " . ($cambioClave?"si":"no");
?>
<?php
    require("Usuario.php");

    $listado = $_GET["listado"];
    if ($listado == "usuarios") {
        echo Usuario::ListarUsuarios();
    }
?>
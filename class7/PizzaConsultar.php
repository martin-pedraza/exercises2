<?php
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];

    echo (Pizza::BuscarPizzaPorTipoSabor($tipo, $sabor)?"Si hay":"No existe el tipo o el sabor");
?>
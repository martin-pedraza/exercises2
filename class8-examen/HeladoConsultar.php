<?php
    include_once("Helado.php");
    include_once("GestorArchivo.php");

    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];

    echo (Helado::BuscarHeladoPorTipoSabor($tipo, $sabor)?"Existe":"No existe el tipo o el sabor");
?>
<?php
    include_once("Helado.php");
    include_once("GestorArchivo.php");

    $id = GestorArchivo::ObtenerID("helado");

    $sabor = $_POST["sabor"];
    $precio = $_POST["precio"];
    $tipo = $_POST["tipo"];
    $vaso = $_POST["vaso"];
    $stock = $_POST["stock"];
    
    $helado = new Helado($id, $sabor, $precio, $tipo, $vaso, $stock);
    
    if(!Helado::BuscarHeladoPorTipoSaborParaActualizarPrecioSumarStock($helado)){
        GestorArchivo::GuardarId($id, "helado");
        $helado->GuardarHelado();
    }

    if (isset($_FILES["imagenHelado"])) {
        $extension = "." . pathinfo($_FILES["imagenHelado"]["name"], PATHINFO_EXTENSION);
        $imagen = $sabor . $tipo . $extension;
        $destino = "ImagenesDeHelados/2023/" . $imagen;
        move_uploaded_file($_FILES["imagenHelado"]["tmp_name"], $destino);
    }
?>
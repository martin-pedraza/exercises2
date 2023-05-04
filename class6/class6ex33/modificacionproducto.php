<?php
    include("Producto.php");

    $codigoDeBarra = $_POST["codigoDeBarra"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $producto = new Producto($codigoDeBarra, $nombre, $tipo, $stock, $precio);
    $productoDB = Producto::TraerUnProductoPorCodigoDeBarra($codigoDeBarra);

    if ($productoDB) {
        if($producto->ActualizarProducto()){
            echo "Actualizado";
        }else{
            echo "No se pudo hacer";
        }
    }else {
        echo "No se pudo hacer";
    }
?>
<?php
    include("Producto.php");

    $codigoDeBarra = $_POST["codigoDeBarra"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $producto = new Producto($codigoDeBarra, $nombre, $tipo, $stock, $precio);

    if ($productoDB = Producto::TraerUnProductoPorCodigoDeBarra($codigoDeBarra)) {
        $productoDB->SumarStock($stock);
        if($productoDB->ActualizarProducto()){
            echo "Actualizado";
        }else{
            echo "No se pudo hacer";
        }
    }else {
        if($producto->CrearProducto()){
            echo "Ingresado";
        }else{
            echo "No se pudo hacer";
        }
    }
?>
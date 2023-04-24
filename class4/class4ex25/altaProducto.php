<?php
    include("Producto.php");

    $codigo = $_POST["codigoDeBarras"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $precio  = $_POST["precio"];
    $stock  = $_POST["stock"];

    $producto = new Producto(1000, $codigo, $nombre, $tipo, $stock, $precio);
    // $producto = new Producto(1000, 123456, "fideos", "alimento", 5, 120);
    Producto::GuardarProducto($producto);
?>
<?php
    require("Usuario.php");
    require("Producto.php");
    require("Venta.php");
    require("GestorArchivo.php");

    $stock = $_POST["cantidad"];
    $codigo = $_POST["codigo"];
    $id = $_POST["idUsuario"];

    // $id = GestorArchivo::ObtenerID();
    $usuario = new Usuario($id, "Martin");
    // GestorArchivo::Guardar("id.txt", $id);

    $producto = new Producto($codigo, $stock);

    // Usuario::GuardarUsuario($usuario);
    // Producto::GuardarProducto($producto);

    $usuarioExiste = Usuario::VerificarUsuarioArchivo($usuario);
    $productoExiste = Producto::VerificarStockProductoArchivo($producto);

    if ($usuarioExiste && is_numeric($productoExiste) && $productoExiste >= $stock) {
        Producto::ModificarStockProductoArchivo($producto);
        $venta = new Venta($id, $codigo);
        Venta::GuardarVenta($venta);
        echo "venta realizada";
    }else {
        echo "no se pudo hacer";
    }
?>
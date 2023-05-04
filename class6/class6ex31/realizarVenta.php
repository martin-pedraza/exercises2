<?php
    include("Producto.php");
    include("Usuario.php");
    include("Venta.php");

    $idUsuario = $_POST["idUsuario"];
    $codigoProducto = $_POST["codigoProducto"];
    $stock = $_POST["stock"];

    // $usuario = new Usuario($idUsuario);
    // $producto = new Producto($codigoProducto, $stock);

    if ($usuarioDB = Usuario::TraerUnUsuarioPorId($idUsuario) 
        && $productoDB = Producto::TraerUnProductoPorCodigoDeBarra($codigoProducto)) {

        if ($productoDB->__get("stock") > $stock) {
            $productoDB->QuitarStock($stock);
            $productoDB->ActualizarProducto();
            $venta = new Venta($idUsuario, $codigoProducto);
            
            if($venta->CrearVenta()){
                echo "Venta realizada";
            }
            else{
                echo "No se pudo hacer";
            }
        }else{
            echo "aqui";
        }
    }else{
        echo "No se pudo hacer";
    }
// ?>
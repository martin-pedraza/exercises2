<?php
    include_once("Venta.php");
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    $email = $_POST["email"];
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $id = GestorArchivo::ObtenerID("venta");
    $pedido = GestorArchivo::ObtenerID("pedido");

    if (Pizza::BuscarPizzaPorTipoSabor($tipo, $sabor) && Pizza::BuscarCantidadPizzaPorTipoSabor($tipo, $sabor) >= $cantidad) {
        Pizza::BuscarPizzaPorTipoSaborParaQuitarStock($tipo, $sabor, $cantidad);
        $venta = new Venta($id, $pedido, $email, $sabor, $tipo, $cantidad, date("Y-m-d"));
        GestorArchivo::GuardarId($id, "venta");
        GestorArchivo::GuardarId($pedido, "pedido");
        
        if (isset($_FILES["imagenVenta"])) {
            $extension = "." . pathinfo($_FILES["imagenVenta"]["name"], PATHINFO_EXTENSION);
            $mail = explode("@", $email);
            $imagen = $tipo . $sabor . $mail[0] . date("Y-m-d") . $extension;
            $destino = "imagenes/imagenesDeLaVenta/" . $imagen;
            move_uploaded_file($_FILES["imagenVenta"]["tmp_name"], $destino);

            $venta->__set("imagen", $imagen);
        }

        $venta->GuardarVenta();   
    }
?>
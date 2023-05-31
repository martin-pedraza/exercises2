<?php
    include_once("Venta.php");
    include_once("Helado.php");
    include_once("GestorArchivo.php");

    $email = $_POST["email"];
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $vaso = $_POST["vaso"];
    $stock = $_POST["stock"];
    $id = GestorArchivo::ObtenerID("venta");
    $pedido = GestorArchivo::ObtenerID("pedido");

    if (Helado::BuscarHeladoPorTipoSabor($tipo, $sabor) && Helado::BuscarCantidadHeladoPorTipoSaborVaso($tipo, $sabor, $vaso) >= $stock) {
        Helado::BuscarHeladoPorTipoSaborParaQuitarStock($tipo, $sabor, $stock);
        $venta = new Venta($id, $pedido, $email, $sabor, $tipo, $vaso, $stock, date("Y-m-d"));
        GestorArchivo::GuardarId($id, "venta");
        GestorArchivo::GuardarId($pedido, "pedido");
        
        if (isset($_FILES["imagenVenta"])) {
            $extension = "." . pathinfo($_FILES["imagenVenta"]["name"], PATHINFO_EXTENSION);
            $mail = explode("@", $email);
            $imagen = $sabor . $tipo .  $vaso . $mail[0] . date("Y-m-d") . $extension;
            $destino = "ImagenesDeLaVenta/2023/" . $imagen;
            move_uploaded_file($_FILES["imagenVenta"]["tmp_name"], $destino);

            $venta->__set("imagen", $imagen);
        }

        $venta->GuardarVenta();   
    }
?>
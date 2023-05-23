<?php
    include_once("Venta.php");
    include_once("Cupon.php");
    include_once("Devolucion.php");
    include_once("GestorArchivo.php");

    $pedido = $_POST["pedido"];
    $causa =  $_POST["causa"];
    $idCupon = GestorArchivo::ObtenerID("cupon");
    $idDescuento = GestorArchivo::ObtenerID("descuento");

    $cupon = new Cupon($idCupon, $idDescuento, 10, "no usado");
    $devolucion = new Devolucion($idDescuento, $idCupon, $causa);
    if (Venta::ValidarPedido($pedido)) {
        $cupon->GuardarCupon();
        $devolucion->GuardarHelado();
    }
?>
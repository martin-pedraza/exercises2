<?php
    include_once("Venta.php");
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    $pedido = $_GET["pedido"];

    if ($venta = Venta::BuscarVentaPorPedido($pedido)) {
        $imagenVenta = $venta->imagen;
        $origen = dirname(__DIR__) . "\imagenes\imagenesDeLaVenta\\" . $imagenVenta;
        $destino = "imagenes/backupventas/" . $imagenVenta;
        rename($origen, $destino);

        Venta::BorrarVentaPorPedido($pedido);
    }
?>
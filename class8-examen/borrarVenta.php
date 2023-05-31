<?php
    include_once("Venta.php");
    include_once("Helado.php");
    include_once("GestorArchivo.php");

    $pedido = $_GET["pedido"];
    
    $venta = Venta::BuscarVentaPorPedido($pedido);
    if ($venta) {
        $imagenVenta = $venta->imagen;
        $origen = __DIR__ . "\\imagenesDeLaVenta\\2023\\" . $imagenVenta;
        $destino = "ImagenesBackupVentas/2023/" . $imagenVenta;
        rename($origen, $destino);

        Venta::BorrarVentaPorPedido($pedido);
    }
?>
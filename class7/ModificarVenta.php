<?php
    include_once("Venta.php");
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    $pedido = $_GET["pedido"];
    $email = $_GET["email"];
    $sabor = $_GET["sabor"];
    $tipo = $_GET["tipo"];
    $cantidad = $_GET["cantidad"];

    if (!Venta::BuscarVentaPorPedidoParaModificar($pedido, $email, $sabor, $tipo, $cantidad)) {
        echo "No existe el pedido";
    }
?>
<?php
    include_once("Venta.php");
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    if(isset($_GET["ventaCantidad"])){
        echo "La cantidad de pizzas vendidas es " . Venta::ConsultarCantidadPizzasVendidas();
    }

    if((isset($_GET["ventaDesde"]) && isset($_GET["ventaHasta"]))){
        echo Venta::ConsultarVentasEntreFechas($_GET["ventaDesde"], $_GET["ventaHasta"]);
    }

    if(isset($_GET["ventaUsuario"])){
        echo Venta::ConsultarVentasPorUsuario($_GET["ventaUsuario"]);
    }

    if(isset($_GET["ventaSabor"])){
        echo Venta::ConsultarVentasPorSabor($_GET["ventaSabor"]);
    }

?>
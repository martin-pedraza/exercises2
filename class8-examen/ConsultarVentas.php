<?php
    include_once("Venta.php");
    include_once("Helado.php");
    include_once("GestorArchivo.php");

    if(isset($_GET["ventaDia"])){
        echo Venta::ConsultarVentasPorDia($dia);
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

    if(isset($_GET["ventaCucurucho"])){
        echo Venta::ConsultarVentasPorVasoCucurucho();
    }
?>
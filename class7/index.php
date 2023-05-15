<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //Carga Pizza
        if (isset($_GET["sabor"]) && isset($_GET["precio"]) && isset($_GET["tipo"]) && isset($_GET["cantidad"])) {
            if ($_GET["tipo"] == "molde" || $_GET["tipo"] == "piedra") {
                include_once("PizzaCarga.php");
            }else{
                echo "Tipo de pizza no valido";
            }
        }
        //Consultas Ventas
        elseif (isset($_GET["ventaCantidad"]) 
            || (isset($_GET["ventaDesde"]) && isset($_GET["ventaHasta"]))
            || isset($_GET["ventaUsuario"])
            || isset($_GET["ventaSabor"])) {
            include_once("ConsultarVentas.php");
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Carga Venta
        if(isset($_POST["email"]) && isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"])){
            include_once("AltaVenta.php");
        }
        //Carga Pizza
        elseif (isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"])) {
            if ($_POST["tipo"] == "molde" || $_POST["tipo"] == "piedra") {
                include_once("PizzaCarga.php");
            }else{
                echo "Tipo de pizza no valido";
            }
        }
        //Consulta Pizza
        elseif (isset($_POST["sabor"]) && isset($_POST["tipo"])) {
            include_once("PizzaConsultar.php");
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
        //Modificar Venta
        if(isset($_GET["pedido"]) && isset($_GET["email"]) && isset($_GET["sabor"]) && isset($_GET["tipo"]) && isset($_GET["cantidad"])){
            if ($_GET["tipo"] == "molde" || $_GET["tipo"] == "piedra") {
                include_once("ModificarVenta.php");
            }
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        //Borrar Venta
        if (isset($_GET["pedido"])){
            include_once("borrarVenta.php");
        }
    }
?>
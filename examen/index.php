<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //Consultas Ventas
        if (isset($_GET["ventaCucurucho"]) 
            || (isset($_GET["ventaDesde"]) && isset($_GET["ventaHasta"]))
            || isset($_GET["ventaUsuario"])
            || isset($_GET["ventaSabor"])
            || isset($_GET["ventaDia"])) {
            include_once("ConsultarVentas.php");
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Carga Venta
        if(isset($_POST["email"]) && isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["vaso"])){
            include_once("AltaVenta.php");
        }
        //Alta helado
        elseif (isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["vaso"]) && isset($_POST["stock"])) {
            if ($_POST["tipo"] == "Agua" || $_POST["tipo"] == "Crema") {
                if ($_POST["vaso"] == "Cucurucho" || $_POST["vaso"] == "Plastico") {
                    include_once("HeladeriaAlta.php");
                }else{
                    echo "Vaso no existe";
                }
            }else{
                echo "Tipo no existe";
            }
        }
        //Consulta helado
        elseif (isset($_POST["sabor"]) && isset($_POST["tipo"])) {
            include_once("HeladoConsultar.php");
        }

        //Devolucion
        elseif(isset($_POST["pedido"]) && isset($_POST["causa"])){
            include_once("DevolverHelado.php");
        }
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
        //Modificar Venta
        if(isset($_GET["pedido"]) && isset($_GET["email"]) && isset($_GET["sabor"]) && isset($_GET["tipo"]) && isset($_GET["vaso"]) && isset($_GET["cantidad"])){
            if ($_POST["tipo"] == "Agua" || $_POST["tipo"] == "Crema") {
                if ($_POST["vaso"] == "Cucurucho" || $_POST["vaso"] == "Plastico") {
                    include_once("ModificarVenta.php");
                }else{
                    echo "Vaso no existe";
                }
            }else{
                echo "Tipo no existe";
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
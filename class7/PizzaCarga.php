<?php
    include_once("Pizza.php");
    include_once("GestorArchivo.php");

    $id = GestorArchivo::ObtenerID("pizza");

    if (isset($_GET["sabor"]) && isset($_GET["precio"]) && isset($_GET["tipo"]) && isset($_GET["cantidad"])) 
    {
        $sabor = $_GET["sabor"];
        $precio = $_GET["precio"];
        $tipo = $_GET["tipo"];
        $cantidad = $_GET["cantidad"];
    }
    else
    {
        $sabor = $_POST["sabor"];
        $precio = $_POST["precio"];
        $tipo = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];
    }

    $pizza = new Pizza($id, $sabor, $precio, $tipo, $cantidad);
    
    if(!Pizza::BuscarPizzaPorTipoSaborParaActualizarPrecioSumarStock($pizza)){
        GestorArchivo::GuardarId($id, "pizza");
        $pizza->GuardarPizza();
    }

    if (isset($_FILES["imagenPizza"])) {
        $extension = "." . pathinfo($_FILES["imagenPizza"]["name"], PATHINFO_EXTENSION);
        $imagen = $tipo . $sabor . $extension;
        $destino = "imagenes/imagenesDePizzas/" . $imagen;
        move_uploaded_file($_FILES["imagenPizza"]["tmp_name"], $destino);
    }
?>
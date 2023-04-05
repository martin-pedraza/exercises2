<?php
    $lapiceraUno = array("color" => "azul", "marca" => "bic", "trazo" => "fino", "precio" => "$500");
    $lapiceraDos = array("color" => "negro", "marca" => "micro", "trazo" => "grueso", "precio" => "$850");
    $lapiceraTres = array("color" => "rojo", "marca" => "pizzini", "trazo" => "fino", "precio" => "$600");

    echo "Lapicera uno: <br>";
    foreach ($lapiceraUno as $key => $value) {
        echo $key . "= " . $value . "<br>";
    }
    
    echo "<br>Lapicera dos: <br>";
    foreach ($lapiceraDos as $key => $value) {
        echo $key . "= " . $value . "<br>";
    }
    
    echo "<br>Lapicera tres: <br>";
    foreach ($lapiceraTres as $key => $value) {
        echo $key . "= " . $value . "<br>";
    }
?>
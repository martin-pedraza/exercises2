<?php
    $lapiceraUno = array("color" => "azul", "marca" => "bic", "trazo" => "fino", "precio" => "$500");
    $lapiceraDos = array("color" => "negro", "marca" => "micro", "trazo" => "grueso", "precio" => "$850");
    $lapiceraTres = array("color" => "rojo", "marca" => "pizzini", "trazo" => "fino", "precio" => "$600");

    $vec1 = array($lapiceraUno, $lapiceraDos, $lapiceraTres);
    $vec2 = array("lapiceraUno" => $lapiceraUno, "lapiceraDos" => $lapiceraDos, "lapiceraTres" => $lapiceraTres);

    foreach ($vec1 as $value) {
        foreach ($value as $key => $value) {
            echo $key . "= " . $value . "<br>";
        }
        echo "<br>";
    }

    foreach ($vec2 as $key => $value) {
        echo $key . "<br>";
        foreach ($value as $key => $value) {
            echo $key . "= " . $value . "<br>";
        }
        echo "<br>";
    }
?>
<?php
    //$vec = array(rand(), rand(), rand(), rand(), rand());
    $vec[0] = rand(0, 5);
    $vec[1] = rand(0, 5);
    $vec[2] = rand(0, 5);
    $vec[3] = rand(0, 5);
    $vec[4] = rand(0, 5);
    $iterador = 0;
    $sumador = 0;

    foreach ($vec as $value) {
        $sumador += $value;
        $iterador++;
    }

    if ($iterador != 0) {
        $promedio = $sumador / $iterador;
    }

    if ($promedio < 6) {
        echo "Promedio menor a seis";
    }

    if ($promedio > 6) {
        echo "Promedio mayor a seis";
    }

    if ($promedio == 6) {
        echo "Promedio igual a seis";
    }
?>
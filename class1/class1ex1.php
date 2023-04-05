<?php
    $sumador = 1;
    $contador = 0;
    while($sumador <= 1000){
        $sumador += $sumador;
        $contador++;
    }
    echo $contador;
?>
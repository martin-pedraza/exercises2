<?php
    $a = 1;
    $b = 5;
    $c = 3;

    $resultado = "No hay valor del medio";

    if ($a < $b && $a < $c) {
        $resultado = $b > $c ? $c : $b;            
    }
    
    if ($b < $a && $b < $c) {
        $resultado = $a > $c ? $c : $a;            
    }

    if ($c < $a && $c < $b) {
        $resultado = $a > $b ? $b : $a;            
    }

    echo $resultado;

?>
<?php
    $num = 1;
    $indice = 0;

    while ($indice < 10) { 
        if ($num % 2 != 0) {
            $vec[$indice] = $num;
            $indice++;
        }
        $num++;
    }
    
    for ($i=0; $i < 10; $i++) { 
        echo $vec[$i] . "<br>";
    }

    $a = 0;
    while ($a < 10) {
        echo $vec[$a] . "<br>";
        $a++;
    }

    foreach ($vec as $value) {
        echo $value . "<br>";
    }
?>
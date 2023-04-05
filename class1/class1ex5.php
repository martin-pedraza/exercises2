<?php
    $num = 33;
    $numeroLetra = "Numero no valido";
    $iterador = 0;

    if ($num == 20) {
        $numeroLetra = "veinte";
    }

    if($num > 20 && $num < 30){
        $numeroLetra = "veinti";
    }

    if($num >= 30 && $num < 40){
        $numeroLetra = "treinta";
    }

    if($num >= 40 && $num < 50){
        $numeroLetra = "cuarenta";
    }
    
    if($num >= 50 && $num < 60){
        $numeroLetra = "cincuenta";
    }

    if ($num > 30 && $num < 60 && $num % 10 != 0) {
        $numeroLetra = $numeroLetra . " y ";
    }

    while($num % 10 != 0 && $num >= 20 && $num <= 60){
        $iterador++;
        $num--;
    }

    switch ($iterador) {
        case 1:
            $numeroLetra = $numeroLetra . "uno";
            break;
        case 2:
            $numeroLetra = $numeroLetra . "dos";
            break;
        case 3:
            $numeroLetra = $numeroLetra . "tres";
            break;
        case 4:
            $numeroLetra = $numeroLetra . "cuatro";
            break;
        case 5:
            $numeroLetra = $numeroLetra . "cinco";
            break;
        case 6:
            $numeroLetra = $numeroLetra . "seis";
            break;
        case 7:
            $numeroLetra = $numeroLetra . "siete";
            break;
        case 8:
            $numeroLetra = $numeroLetra . "ocho";
            break;
        case 9:
            $numeroLetra = $numeroLetra . "nueve";
            break;
        default:
            break;
    }

    echo $numeroLetra;
?>
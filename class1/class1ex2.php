<?php
    echo date("d-m-Y");
    echo date("d-M-Y");
    echo date("Y-m-d H:i:s");

    $dia = date("d");
    $mes = date("m");
    switch($mes){
        case 1:
        case 2:
        case 3:
            if($dia < 21){
                echo "Verano";
            }else{
                echo "Otoño";
            }
            break;
        case 4:
        case 5:
        case 6:
            if($dia < 21){
                echo "Otoño";
            }else{
                echo "Invierno";
            }
            break;
        case 7:
        case 8:
        case 9:
            if($dia < 21){
                echo "Invierno";
            }else{
                echo "Primavera";
            }
            break;
        case 10:
        case 11:
        case 12:
            if($dia < 21){
                echo "Primavera";
            }else{
                echo "Verano";
            }
            break;
        default:
            echo "Imposible";
    }
?>
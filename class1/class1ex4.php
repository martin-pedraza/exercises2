<?php
    $operador = '/';
    $op1 = 3;
    $op2 = 0;

    switch($operador){
        case '+':
            echo $op1 + $op2;
            break;
        case '-':
            echo $op1 - $op2;
            break;
        case '*':
            echo $op1 * $op2;
            break;
        case '/':
            if ($op2 != 0) {
                echo $op1 / $op2;
            }else{
                echo "No se divide por cero";
            }
            break;
        default:
            echo "Simbolo no válido";
    }
?>
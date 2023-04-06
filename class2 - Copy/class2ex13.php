<?php
    function ValidarCantidadCaracteres($palabra, $max){
        if (strlen($palabra) <= $max) {
            if ($palabra == "Recuperatorio" || $palabra == "Parcial" || $palabra == "Programacion") {
                return 1;
            }
        }
        return 0;
    }
?>
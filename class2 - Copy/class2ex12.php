<?php
    function MostrarArray($vec){
        foreach ($vec as $value) {
            echo $value;
        }    
    }

    function InvertirOrden($vec){
        krsort($vec);
        MostrarArray($vec);
    }

    $vec = array("H", "O", "L", "A");

    InvertirOrden($vec);

?>
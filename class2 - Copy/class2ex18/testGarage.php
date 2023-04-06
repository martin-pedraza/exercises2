<?php
    include "./Garage.php";
    include "./Auto.php";

    $autoUno = new Auto("Fiat", "Negro");
    $autoDos = new Auto("Ford", "Gris", 500000);
    $autoTres = new Auto("Citroen", "Azul", 1800000, date("d-m-Y"));

    $garageUno = new Garage("Estacionamiento Jose");
    $garageDos = new Garage("Garages Modernos", 300);

    echo "Se ha podido agregar el auto uno en el primer garage? " . $garageUno->Add($autoUno) . "<br>";
    echo "Se ha podido agregar el auto uno en el primer garage? " . $garageUno->Add($autoUno) . "<br>";
    echo "Se ha podido retirar el auto uno en el primer garage? " . $garageUno->Remove($autoUno) . "<br>";
    echo "Se ha podido retirar el auto uno en el primer garage? " . $garageUno->Remove($autoUno) . "<br>";

    $garageDos->Add($autoDos);
    $garageDos->Add($autoTres);
    
    $garageDos->MostrarGarage();
?>
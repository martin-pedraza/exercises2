<?php
    require "./Auto.php";

    $autoUno = new Auto("Fiat", "Negro");
    $autoDos = new Auto("Fiat", "Blanco");
    $autoTres = new Auto("Ford", "Gris", 500000);
    $autoCuatro = new Auto("Ford", "Gris", 2300000);
    $autoCinco = new Auto("Citroen", "Azul", 1800000, date("d-m-Y"));

    $autoTres->AgregarImpuestos(1500);
    $autoCuatro->AgregarImpuestos(1500);
    $autoCinco->AgregarImpuestos(1500);

    echo "La suma del primer auto y del segundo es " . Auto::Add($autoUno, $autoDos) . "<br>";

    echo "Son iguales el primer auto y el segundo: " . ($autoUno->Equals($autoDos) ? "si":"no") . "<br>";
    echo "Son iguales el primer auto y el quinto: " . ($autoUno->Equals($autoCinco) ? "si":"no") . "<br>";

    Auto::MostrarAuto($autoUno);
    Auto::MostrarAuto($autoTres);
    Auto::MostrarAuto($autoCinco);

    // Auto::GuardarAutoEnArchivo($autoCuatro);
    // Auto::GuardarAutoEnArchivo($autoTres);
    // Auto::GuardarAutoEnArchivo($autoDos);
    $arrayAutos = Auto::LeerAutosEnArchivo();
    foreach ($arrayAutos as $value) {
        Auto::MostrarAuto($value);
    }
?>
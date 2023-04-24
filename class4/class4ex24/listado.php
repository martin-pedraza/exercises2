<?php
    include ("Usuario.php");

    $lista = $_GET["lista"];

    $usuarios = array();
    if ($lista == "usuarios") {
        $usuarios = Usuario::LeerArchivoUsuarios();
    }

    if (count($usuarios) > 0) { 
        $html = "<ul>";
        foreach ($usuarios as $value) {
            $html .= "<li>" . $value->_nombre . "</li>";
        }
        $html .= "</ul>";
        echo $html;
    }
    else {
        echo "No hay usuarios";
    }
?>
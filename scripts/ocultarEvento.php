<?php

    include("bd.php");

    session_start();

    $resto = explode("/", $uri);

    $idEv = intval($resto[2]); // Si no es un entero devuelve 0

    if(strcmp($resto[1], "mostrarEvento") === 0) {
        $mostrar = true;
    }
    elseif(strcmp($resto[1], "ocultarEvento") === 0) {
        $mostrar = false;
    }
    
    $mysqli = conectar();

    if(isset($_SESSION['nickUsuario']))
    {
        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

        if($usuario['gestor'] OR $usuario['superusuario'])
        {
            ocultarMostrarEvento($idEv, $mostrar, $mysqli);
        }
    }

    header("Location: /inicio");
?>
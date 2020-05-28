<?php

    include("bd.php");

    $resto = explode("/", $uri);

    $idEv = intval($resto[2]); // Si no es un entero devuelve 0

    $variablesParaTwig = array();

    $mysqli = conectar();
    
    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);
        $variablesParaTwig['usuario'] = $usuario;

        if($usuario['superusuario'] || $usuario['gestor'])
        {
            $evento = getEvento($idEv, $mysqli);

            $variablesParaTwig['evento'] = $evento;
            $variablesParaTwig['idEv'] = $idEv;

            echo $twig->render('editarEvento.html', $variablesParaTwig);
        }
        else
            header("Location: /inicio");
    }
    else
        header("Location: /inicio");
?>
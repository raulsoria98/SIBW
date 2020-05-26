<?php

    include("bd.php");

    $resto = substr($uri, 8);

    $idEv = intval($resto); // Si no es un entero devuelve 0

    $variablesParaTwig['idEv'] = $idEv;

    $mysqli = conectar();

    $evento = getEvento($idEv, $mysqli);

    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $variablesParaTwig['usuario'] = getUsuario($_SESSION['nickUsuario'], $mysqli);
    }

    echo $twig->render('evento.html', $evento + $variablesParaTwig);
?>
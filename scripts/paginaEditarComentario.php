<?php

    include("bd.php");

    $resto = explode("/", $uri);

    $idCom = intval($resto[3]); // Si no es un entero devuelve 0
    $idEv = intval($resto[2]);
    $mensaje = urldecode($resto[4]);

    $variablesParaTwig['mensaje'] = $mensaje;
    $variablesParaTwig['idCom'] = $idCom;
    $variablesParaTwig['idEv'] = $idEv;
    
    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $variablesParaTwig['usuario'] = getUsuario($_SESSION['nickUsuario'], $mysqli);
    }

    echo $twig->render('editarComentario.html', $variablesParaTwig);
?>
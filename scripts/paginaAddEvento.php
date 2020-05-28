<?php

    include("bd.php");

    $variablesParaTwig = array();
    
    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $mysqli = conectar();

        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);
        $variablesParaTwig['usuario'] = $usuario;
        
        if($usuario['superusuario'] || $usuario['gestor'])
            echo $twig->render('addEvento.html', $variablesParaTwig);
    }

    header("Location: /inicio");
?>
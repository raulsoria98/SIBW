<?php

    include("bd.php");

    $variablesParaTwig = array();
    
    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $mysqli = conectar();

        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);
        $variablesParaTwig['usuario'] = $usuario;
        
        if($usuario['superusuario'])
            $variablesParaTwig['usuarios'] = getUsuarios($mysqli);
    }

    echo $twig->render('editarPermisos.html', $variablesParaTwig);
?>
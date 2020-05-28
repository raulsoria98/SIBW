<?php

    include("bd.php");

    $resto = explode("/", $uri);

    $idEv = intval($resto[2]);  // Si no es un entero devuelve 0

    $mysqli = conectar();

    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

        if($usuario['gestor'] OR $usuario['superusuario'])
        {
            borrarEvento($idEv, $mysqli);
        }
    }


    // FIXME: conseguir que se abra la ventana de comentarios al actualizar la página
    header("Location: /inicio");
    // echo $twig->render('evento.html', $evento + $variablesParaTwig);
    // echo'<script type="text/javascript">
    //             comentario();
    //     </script>';
?>
<?php

    include("bd.php");

    $resto = explode("/", $uri);

    $idCom = intval($resto[3]); // Si no es un entero devuelve 0
    $idEv = intval($resto[2]);

    // $variablesParaTwig['idEv'] = $idEv;

    // $mysqli = conectar();

    // $evento = getEvento($idEv, $mysqli);

    // session_start();

    // if(isset($_SESSION['nickUsuario']))
    // {
    //     $variablesParaTwig['usuario'] = getUsuario($_SESSION['nickUsuario'], $mysqli);
    // }

    session_start();

    if(isset($_SESSION['nickUsuario']))
    {
        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

        if($usuario['moderador'] OR $usuario['superusuario'])
        {
            borrarComentario($idCom, $mysqli);
        }
    }


    // FIXME: conseguir que se abra la ventana de comentarios al actualizar la página
    header("Location: /evento/" . $idEv);
    // echo $twig->render('evento.html', $evento + $variablesParaTwig);
    // echo'<script type="text/javascript">
    //             comentario();
    //     </script>';
?>
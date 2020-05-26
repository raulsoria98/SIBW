<?php

    include("bd.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $mensaje = $_POST['mensaje'];
        $idEv = $_POST['idEv'];
        $email = $_POST['email'];

        session_start();

        if(isset($_SESSION['nickUsuario']) && $mensaje != null && $email != null)
        {
            $mysqli = conectar();

            $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

            date_default_timezone_set ( 'Europe/Madrid' ); 
            $fecha = new DateTime('NOW');
            $fecha = $fecha->format('Y-m-d H:i:s');

            enviarComentario($usuario['nick'], $mensaje, $fecha, $idEv, $mysqli);
        }
    }
    
    header("Location: /evento/" . $idEv);
?>
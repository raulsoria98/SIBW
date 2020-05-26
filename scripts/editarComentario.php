<?php

    include("bd.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $idCom = $_POST['idCom'];
        $idEv = $_POST['idEv'];
        $mensaje = $_POST['mensaje'];

        if($mensaje != null)
        {
            $mysqli = conectar();

            session_start();

            if(isset($_SESSION['nickUsuario']))
            {
                $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

                if($usuario['moderador'] OR $usuario['superusuario'])
                {
                    editarComentario($idCom, $mensaje, $mysqli);
                }
            }

        }
    }
    
    header("Location: /evento/" . $idEv);
?>
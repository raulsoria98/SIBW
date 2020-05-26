<?php

    include("bd.php");

    session_start();

    $mysqli = conectar();

    $resto = explode("/", $uri);

    $nick = urldecode($resto[2]);

    if(isset($_SESSION['nickUsuario']))
    {
        $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

        if($usuario['superusuario'])
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $nombre = $_POST['nombre'];
                
                if(isset($_POST['permisos']))
                {
                    if(in_array('moderador', $_POST['permisos']))
                        $moderador = 1;
                    else
                        $moderador = 0;
                    
                    if(in_array('gestor', $_POST['permisos']))
                        $gestor = 1;
                    else
                        $gestor = 0;
        
                    if(in_array('superusuario', $_POST['permisos']))
                        $superusuario = 1;
                    else
                        $superusuario = 0;
                }
                
                editarUsuario($nick, $nombre, $moderador, $gestor, $superusuario, $mysqli);
            }
        }
    }
    
    header("Location: /paginaEditarPermisos");
?>
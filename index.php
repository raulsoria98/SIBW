<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $uri = $_SERVER['REQUEST_URI'];

    function startsWith($string, $query) {
        return substr($string, 0, strlen($query)) === $query;
    }

    if(startsWith($uri, "/evento"))
    {
        include("scripts/evento.php");
    }
    elseif (startsWith($uri, "/imprimir"))
    {
        include("scripts/imprimir.php");
    }
    elseif (startsWith($uri, "/login"))
    {
        include("scripts/login.php");
    }
    elseif (startsWith($uri, "/registrar"))
    {
        include("scripts/registrar.php");
    }
    elseif (startsWith($uri, "/logout"))
    {
        include("scripts/logout.php");
    }
    elseif (startsWith($uri, "/borrarComentario"))
    {
        include("scripts/borrarComentario.php");
    }
    elseif (startsWith($uri, "/enviarComentario"))
    {
        include("scripts/enviarComentario.php");
    }
    elseif (startsWith($uri, "/paginaEditarComentario"))
    {
        include("scripts/paginaEditarComentario.php");
    }
    elseif (startsWith($uri, "/editarComentario"))
    {
        include("scripts/editarComentario.php");
    }
    elseif (startsWith($uri, "/paginaEditarPermisos"))
    {
        include("scripts/paginaEditarPermisos.php");
    }
    elseif (startsWith($uri, "/editarPermisos"))
    {
        include("scripts/editarPermisos.php");
    }
    elseif (startsWith($uri, "/borrarEvento"))
    {
        include("scripts/borrarEvento.php");
    }
    elseif (startsWith($uri, "/paginaAddEvento"))
    {
        include("scripts/paginaAddEvento.php");
    }
    elseif (startsWith($uri, "/addEvento"))
    {
        include("scripts/addEvento.php");
    }
    elseif (startsWith($uri, "/paginaEditarEvento"))
    {
        include("scripts/paginaEditarEvento.php");
    }
    elseif (startsWith($uri, "/editarEvento"))
    {
        include("scripts/editarEvento.php");
    }
    else
    {
        include("scripts/bd.php");
        
        $mysqli = conectar();

        $variablesParaTwig = array();

        $variablesParaTwig['eventos'] = getEventos($mysqli);

        session_start();

        if(isset($_SESSION['nickUsuario']))
        {
            $variablesParaTwig['usuario'] = getUsuario($_SESSION['nickUsuario'], $mysqli);
        }

        echo $twig->render('portada.html', $variablesParaTwig);
    }

?>
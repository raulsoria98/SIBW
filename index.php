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
    else
    {
        echo $twig->render('portada.html', []);
    }

?>
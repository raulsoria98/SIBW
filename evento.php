<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    $script = 'js/evento.js';

    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
        if(!is_numeric($idEv))
            $idEv = -1;
    } else {
        $idEv = -1;
    }

    $evento = getEvento($idEv);
    
    echo $twig->render('evento.html', ['titulo' => $evento['titulo'], 'subtitulo' => $evento['subtitulo'], 'imagen' => $evento['imagen'], 'parrafos' => $evento['parrafos'], 'comentarios' => $evento['comentarios'], 'idEv' => $idEv, 'script' => $script]);
?>
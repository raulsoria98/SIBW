<?php

    include("bd.php");

    $resto = substr($uri, 8);

    $idEv = intval($resto); // Si no es un entero devuelve 0

    $script = '/js/evento.js';

    $evento = getEvento($idEv);
    
    echo $twig->render('evento.html', ['titulo' => $evento['titulo'], 'subtitulo' => $evento['subtitulo'], 'imagen' => $evento['imagen'], 'parrafos' => $evento['parrafos'], 'comentarios' => $evento['comentarios'], 'idEv' => $idEv, 'script' => $script]);
?>
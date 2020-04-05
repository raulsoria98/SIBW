<?php

    include("bd.php");

    $resto = substr($uri, 10);

    $idEv = intval($resto); // Si no es un entero devuelve 0

    $evento = getEvento($idEv);
    
    echo $twig->render('imprimir.html', ['titulo' => $evento['titulo'], 'subtitulo' => $evento['subtitulo'], 'imagen' => $evento['imagen'], 'parrafos' => $evento['parrafos'], 'idEv' => $idEv]);
?>
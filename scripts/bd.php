<?php

    function conectar()
    {
        $mysqli = new mysqli("mysql", "ray", "sibw1920", "MotocicletasRS");
        if($mysqli->connect_errno) {
            echo ("Fallo al conectar: " . $mysqli->connect_errno);
        }

        return $mysqli;
    }

    function getEvento($idEv)
    {
        $mysqli = conectar();

        $res = $mysqli->query("SELECT titulo, subtitulo, imagen, parrafos FROM eventos WHERE idEv=" . $idEv);

        $evento = array('titulo' => "Página de error", 'subtitulo' => "No se ha recuperado el evento");

        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();

            $comentarios = getComentarios($idEv, $mysqli);

            // explode() separa un string en un array de strings delimitados por el caracter indicado
            $evento = array('titulo' => $row['titulo'], 'subtitulo' => $row['subtitulo'], 'imagen' => $row['imagen'], 'parrafos' => explode("\n", $row['parrafos']), 'comentarios' => $comentarios);
        }

        return $evento;
    }

    function getComentarios($idEv, $mysqli)
    {
        $res = $mysqli->query("SELECT mensaje, nombre, fecha FROM comentarios WHERE idEv=" . $idEv . " ORDER BY fecha");

        $comentarios = array();

        if($res->num_rows > 0)
        {
            while ($row = $res->fetch_assoc()) {
                $fecha = new DateTime($row['fecha']);
                $fecha = $fecha->format('d/m/Y H:i:s');
                $nuevo = array('mensaje' => $row['mensaje'], 'nombre' => $row['nombre'], 'fecha' => $fecha);
                array_push($comentarios, $nuevo);
            }
        }

        return $comentarios;
    }

?>
<?php

    function conectar()
    {
        $mysqli = new mysqli("mysql", "ray", "sibw1920", "MotocicletasRS");
        if($mysqli->connect_errno) {
            echo ("Fallo al conectar: " . $mysqli->connect_errno);
        }

        return $mysqli;
    }

    function getEvento($idEv, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $res = $mysqli->query("SELECT titulo, subtitulo, imagen, parrafos FROM eventos WHERE idEv=" . $idEv);

        $evento = array('titulo' => "Página de error", 'subtitulo' => "No se ha recuperado el evento", 'error' => true);

        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();

            $comentarios = getComentarios($idEv, $mysqli);

            // explode() separa un string en un array de strings delimitados por el caracter indicado
            $evento = array('titulo' => $row['titulo'], 'subtitulo' => $row['subtitulo'], 'imagen' => $row['imagen'], 'parrafos' => explode("\n", $row['parrafos']), 'comentarios' => $comentarios, 'error' => false);
        }

        return $evento;
    }

    function getComentarios($idEv, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $res = $mysqli->query("SELECT mensaje, nombre, fecha, idCom FROM comentarios WHERE idEv=" . $idEv . " ORDER BY fecha");

        $comentarios = array();

        if($res->num_rows > 0)
        {
            while ($row = $res->fetch_assoc()) {
                $fecha = new DateTime($row['fecha']);
                $fecha = $fecha->format('d/m/Y H:i:s');
                $nuevo = array('mensaje' => $row['mensaje'], 'nombre' => $row['nombre'], 'fecha' => $fecha, 'idCom' => $row['idCom']);
                array_push($comentarios, $nuevo);
            }
        }

        return $comentarios;
    }

    function getUsuario($nickUsuario, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $res = $mysqli->query("SELECT * FROM usuarios WHERE nick='" . $nickUsuario . "'");

        $usuario = array('existe' => false);

        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();

            $usuario['existe'] = true;
            $usuario = $usuario + $row;
        }

        return $usuario;
    }

    function checkLogin($nick, $pass)
    {
        $usuario = getUsuario($nick);

        if($usuario['existe'])
        {
            if(password_verify($pass, $usuario['pass']))
            {
                return true;
            }
        }

        return false;
    }

    function registrarUsuario($nick, $pass)
    {
        $mysqli = conectar();

        $mysqli->query("INSERT INTO usuarios (nick, pass) VALUES ('" . $nick . "', '" . $pass . "')");
    }

    function borrarComentario($idCom, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $mysqli->query("DELETE FROM `comentarios` WHERE `comentarios`.`idCom` =" . $idCom);
    }

    function enviarComentario($nombre, $mensaje, $fecha, $idEv, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $mysqli->query("INSERT INTO `comentarios` (`idEv`, `mensaje`, `nombre`, `fecha`) VALUES ('" . $idEv . "', '" . $mensaje . "', '" . $nombre . "', '" . $fecha . "')");
    }

    function editarComentario($idCom, $mensaje, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $mysqli->query("UPDATE `comentarios` SET `mensaje` = '" . $mensaje . "' WHERE `comentarios`.`idCom` =" . $idCom);
    }

    function getUsuarios($mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $res = $mysqli->query("SELECT * FROM usuarios");

        $usuarios = array();

        if($res->num_rows > 0)
        {
            while ($row = $res->fetch_assoc()) {
                array_push($usuarios, $row);
            }
        }

        return $usuarios;
    }

    function editarUsuario($nick, $nombre, $moderador, $gestor, $superusuario, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $mysqli->query("UPDATE `usuarios` SET `nick` = '" . $nombre . "', `moderador` = b'" . $moderador . "', `gestor` = b'" . $gestor . "', `superusuario` = b'" . $superusuario . "' WHERE `usuarios`.`nick` = '" . $nick . "'");
    }
?>
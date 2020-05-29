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

    function getEventos($publicado ,$mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();
        
        $res = $mysqli->query("SELECT idEv, portada, titulo FROM `eventos` WHERE `eventos`.`publicado` = b'" . $publicado . "' ORDER BY idEv");

        $eventos = array();
        $conjunto = array();

        if($res->num_rows > 0)
        {
            while ($row = $res->fetch_assoc()) {
                if(count($conjunto) < 3) {
                    array_push($conjunto, $row);
                }
                else {
                    array_push($eventos, $conjunto);
                    $conjunto = array();
                    array_push($conjunto, $row);
                }
            }
            if(!empty($conjunto))
                array_push($eventos, $conjunto);
        }

        return $eventos;
    }

    function borrarEvento($idEv, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        $mysqli->query("DELETE FROM `eventos` WHERE `eventos`.`idEv` =" . $idEv);
    }

    function addEvento($idEv, $titulo, $subtitulo, $parrafos, $imagen, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();
        
        $mysqli->query("INSERT INTO `eventos` (`idEv`, `titulo`, `subtitulo`, `parrafos`, `portada`, `imagen`) VALUES ('" . $idEv . "', '" . $titulo . "', '" . $subtitulo . "', '" . $parrafos . "', '" . $imagen . "', '" . $imagen . "')");
    }

    function editarEvento($idAntiguo, $idEv, $titulo, $subtitulo, $parrafos, $rutaImg, $mysqli = false)
    {
        if(!$mysqli)
            $mysqli = conectar();

        if($rutaImg == null)
            $sql = "UPDATE `eventos` SET `idEv` = '" . $idEv . "', `titulo` = '" . $titulo . "', `subtitulo` = '" . $subtitulo . "', `parrafos` = '" . $parrafos . "' WHERE `eventos`.`idEv` = " . $idAntiguo;
        else
            $sql = "UPDATE `eventos` SET `idEv` = '" . $idEv . "', `titulo` = '" . $titulo . "', `subtitulo` = '" . $subtitulo . "', `portada` = '" . $rutaImg . "', `imagen` = '" . $rutaImg . "', `parrafos` = '" . $parrafos . "' WHERE `eventos`.`idEv` = " . $idAntiguo;
        
        $mysqli->query($sql);
    }

    function ocultarMostrarEvento($idEv, $mostrar, $mysqli = flase)
    {
        if(!$mysqli)
            $mysqli = conectar();
        
        $mysqli->query("UPDATE `eventos` SET `publicado` = b'" . $mostrar . "' WHERE `eventos`.`idEv` = " . $idEv);
    }
?>
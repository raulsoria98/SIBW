<?php

    include("bd.php");

    $resto = explode("/", $uri);

    $idAntiguo = intval($resto[2]); // Si no es un entero devuelve 0

    $mysqli = conectar();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $idEv = $_POST['idEv'];
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $parrafos = $_POST['parrafos'];
        $rutaImg = null;
        
        if(isset($_FILES['imagen']))
        {
            $errores = array();
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_type = $_FILES['imagen']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));

            $extensions= array("jpeg","jpg","png");
        
            if (in_array($file_ext,$extensions) === false){
                $errores[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
                $errores[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errores)==true) {
                $rutaImg = "img/" . $file_name;
                move_uploaded_file($file_tmp, $rutaImg);
                $rutaImg = "/" . $rutaImg;
            }
        }
    
        session_start();

        if(isset($_SESSION['nickUsuario']) && $idEv != null && $titulo != null)
        {
            $usuario = getUsuario($_SESSION['nickUsuario'], $mysqli);

            if($usuario['superusuario'] || $usuario['gestor'])
            {
                editarEvento($idAntiguo, $idEv, $titulo, $subtitulo, $parrafos, $rutaImg, $mysqli);
            }

            header("Location: /inicio");
        }
        else
        {
            $variablesParaTwig['idEv'] = $idAntiguo;
            $variablesParaTwig['usuario'] = $usuario;
            $variablesParaTwig['evento'] = getEvento($idAntiguo, $mysqli);
            echo $twig->render('editarEvento.html', $variablesParaTwig);

            echo'<script type="text/javascript">
                alert("Los campos que tienen un asterisco (*) son obligatorios");
            </script>';
        }
    }
    
    header("Location: /inicio");
?>
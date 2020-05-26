<?php

    include("bd.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $nick = $_POST['nombre'];
        $pass = $_POST['password'];

        $usuario = getUsuario($nick);

        if($usuario['existe'] === false AND $nick != null AND $pass != null)
        {
            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
            
            registrarUsuario($nick, $hash_pass);

            session_start();

            $_SESSION['nickUsuario'] = $nick;
            
            header("Location: inicio");
        }
        elseif($usuario['existe'])
        {   
            echo $twig->render('login.html');

            echo'<script type="text/javascript">
                alert("Usuario ya registrado");
            </script>';
        }
        else
        {   
            echo $twig->render('login.html');

            echo'<script type="text/javascript">
                alert("Rellene los campos");
            </script>';
        }
        
        exit();
    }
    
    echo $twig->render('login.html');
?>
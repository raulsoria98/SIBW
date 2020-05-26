<?php

    include("bd.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $nick = $_POST['nombre'];
        $pass = $_POST['password'];

        if(checkLogin($nick, $pass))
        {
            session_start();

            $_SESSION['nickUsuario'] = $nick;
            
            header("Location: inicio");
        }
        else
        {
            echo $twig->render('login.html');

            echo'<script type="text/javascript">
                    alert("Nombre de usuario o contraseña incorrectos");
                </script>';
        }
        
        exit();
    }
    
    echo $twig->render('login.html');
?>
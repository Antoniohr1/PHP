<?php

if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];
    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include "index.php";
    } else if(!$usuario == "admin" && !$password == "admin") {
        session_start();
            include "inicio3.php";
            foreach($vc->getSocio() as $usu){
                if ($usu->getUser()== $usuario){
                    $usuarioLogeado=[$usuario=>$password];
                }
            }
            $_SESSION['usuario'] = $usuario;
            include "main.php";
     } else if ($usuario == "usuario" && $password == "usuario") {
            session_start();
            $_SESSION['usuario'] = $usuario;
            
            include "main.php";

        }else if($usuario == "admin" && $password == "admin"){
            session_start();
            $_SESSION['admin'] = $usuario;
            $_SESSION['datos'] ="inicio3.php";
            include "mainAdmin.php";
            
        }else {
            $error = "Usuario o contraseña no válidos!";
            include "index.php";
        }
    }
?>


<?php

if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include "index.php";
    } else {
        if ($usuario == "usuario" && $password == "usuario") {
            session_start();
            $_SESSION['usuario'] = $usuario;
            
            include "main.php";

        }else if($usuario == "admin" && $password == "admin"){

            session_start();
            $_SESSION['admin'] = $usuario;

            $_SESSION["soportes"] = ["God of War", "The Last of Us Part II","Torrente","Origen","El Imperio Contraataca","Los cazafantasmas","El nombre de la Rosa"];
            $_SESSION["clientes"] = ["Amancio Ortega", "Pablo Picasso"];
            include "mainAdmin.php";

        }else {
            $error = "Usuario o contraseña no válidos!";
            include "index.php";
        }
    }
}

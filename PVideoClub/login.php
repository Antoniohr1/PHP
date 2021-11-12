<?php
//Soportes
$todosSoportes = [
    ["Nombre" => "God of War", "Precio" => 19.99, "Consola" => "PS4", "MinJugadores" => 1, "MaxJugadores" => 1],
    ["Nombre" => "The Last of Us Part II", "Precio" => 49.99, "Consola" => "PS4", "MinJugadores" => 1, "MaxJugadores" => 1],
    ["Nombre" => "Torrente", "Precio" => 4.5, "Idioma" => "es", "Formato Pantalla" => "16:9"],
    ["Nombre" => "Origen", "Precio" => 4.5, "Idioma" => "es,en,fr", "Formato Pantalla" => "16:9"],
    ["Nombre" => "El Imperio Contraataca", "Precio" => 3, "Idioma" => "es,en", "Formato Pantalla" => "16:9"],
    ["Nombre" => "Los cazafantasmas", "Precio" => 3.5, "Duracion" => 107],
    ["Nombre" => "El nombre de la Rosa", "Precio" => 1.5, "Duracion" => 140]
];
//Clientes
$todosClientes = [
    ["ID"=>0,"Nombre" => "Amancio Ortega", "Usuario" => "amancio", "Contraseña" => "amancio"],
    ["ID"=>1,"Nombre" => "Pablo Picasso", "Usuario" => "pablo", "Contraseña" => "pablo"]
];
if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];
    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include "index.php";
    } else if ($usuario == "admin" && $password == "admin") {
        session_start();
        $_SESSION['admin'] = $usuario;
        $_SESSION['soporte'] = $todosSoportes;
        $_SESSION['cliente'] = $todosClientes;
        include "mainAdmin.php";
    } else if (isset($usuario) && isset($password)) {
        session_start();
        $existe = false;
        foreach ($todosClientes as $cliente) {
            foreach ($cliente as $socio => $usu) {
            if ($socio == "Usuario" && $usuario == $usu) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['cliente']=$todosClientes;
                $existe = true;
                include "mainCliente.php";
            }
        }
    }
        if ($existe == false) {
            $error = "Usuario o contraseña no válidos!";
            include_once "index.php";
        }
    }
} else {
    $error = "Usuario o contraseña no válidos!";
    include "index.php";
}

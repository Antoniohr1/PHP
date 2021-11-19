<?php

include "inicio3.php";

if(!isset($_SESSION)) {
    session_start();
}


if(!isset($_SESSION["usuario"])) {
    $usuario=$_SESSION["admin"];
}else {
    $usuario=$_SESSION["usuario"];
}

if ($usuario!="admin") {

    $newNombre = $_POST["nombre"];
    $newUsuario = $_POST['formUsuario'];
    $newPassword = $_POST['formPassword'];

    if (empty($newNombre) || empty($newUsuario)|| empty($newPassword)) {
        $error = "Debes introducir un usuario y contraseña";
        //header("Location: formCreateCliente.php");
        include "formCreateCliente.php";
    }elseif ((!preg_match('/^[A-ZÁÉÍÓÚ][a-záéíóú]*$/', $newNombre))) {
        $error = "Debes introducir un nombre válido";
        //header("Location: formCreateCliente.php");
        include "formCreateCliente.php";
    }else{
        $_SESSION["newNombre"] = $newNombre;
        $_SESSION["newUsuario"]=$newUsuario;
        $_SESSION["newPassword"]=$newPassword;

        
        $arrayClientes=$_SESSION["cliente"];

        foreach ($arrayClientes as $cliente) {
            foreach ($cliente as $usu => $dato) {
                if ($usu=="ID") {
                    $id=$dato;
                }
                if($usu=="Usuario" && $dato==$usuario){
                    $posicion=$id;
                }
            }
        }

        unset($arrayClientes[$posicion]);

        $_SESSION["cliente"][$posicion]=["ID"=>$posicion, "Nombre" => $newNombre, "Usuario" => $newUsuario, "Contraseña" => $newPassword];

        $vc->incluirSocio($newNombre,$newUsuario,$newPassword);

        header("Location: mainCliente.php");
       
    }

}else {
    $newNombre = $_POST["nombre"];
    $newUsuario = $_POST['formUsuario'];
    $newPassword = $_POST['formPassword'];
    $usuarioModificado = $_POST['modificar'];

    if (empty($newNombre) || empty($newUsuario)|| empty($newPassword)) {
        $error = "Debes introducir un usuario y contraseña";
        //header("Location: formCreateCliente.php");
        include "formCreateCliente.php";
    }elseif ((!preg_match('/^[A-ZÁÉÍÓÚ][a-záéíóú]*$/', $newNombre))) {
        $error = "Debes introducir un nombre válido";
        //header("Location: formCreateCliente.php");
        include "formCreateCliente.php";
    }else{
        $_SESSION["newNombre"] = $newNombre;
        $_SESSION["newUsuario"]=$newUsuario;
        $_SESSION["newPassword"]=$newPassword;

        
        $arrayClientes=$_SESSION["cliente"];

        foreach ($arrayClientes as $cliente) {
            foreach ($cliente as $usu => $dato) {
                if ($usu=="ID") {
                    $id=$dato;
                }
                if($usu=="Usuario" && $dato==$usuarioModificado){
                    $posicion=$id;
                }
            }
        }

        unset($arrayClientes[$posicion]);

        $_SESSION["cliente"][$posicion]=["ID"=>$posicion, "Nombre" => $newNombre, "Usuario" => $newUsuario, "Contraseña" => $newPassword];

        $vc->incluirSocio($newNombre,$newUsuario,$newPassword);
        
        header("Location: mainAdmin.php");
    }
}
?>
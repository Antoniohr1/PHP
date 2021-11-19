<?php

include "inicio3.php";

if(!isset($_SESSION)) {
    session_start();
}

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

    $cont=count($arrayClientes);

    $_SESSION["cliente"][$cont]=["ID"=>$cont, "Nombre" => $newNombre, "Usuario" => $newUsuario, "Contraseña" => $newPassword];

    $vc->incluirSocio($newNombre,$newUsuario,$newPassword);

    header("Location: mainAdmin.php");
}
?>
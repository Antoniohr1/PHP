<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
include "inicio3.php";
include("vendor/autoload.php");
$clientes = $_SESSION['cliente'];
$usuario = $_SESSION['usuario'];


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de películas</title>
</head>

<body>
    <h1>Bienvenido <?= $_SESSION['usuario'] ?></h1>
    <p>Pulse <a href="logout.php">aquí</a> para salir</p>
    <p>Pulse <a href="formUpdateCliente.php">aquí</a> para modificar un Cliente</p> 


    <h2>Lista de Alquileres</h2>
    <?php
    $arraySocio = $vc->getSocio();
    foreach ($clientes as $cliente) {
        foreach ($cliente as $usu => $dato) {
            if ($usu=="ID") {
                $id=$dato;
            }
            if($usu=="Usuario" && $dato==$usuario){
                $posicion=$id;
            }
        }
    }
    
    $alquileresSocio = $arraySocio[$posicion]->getAlquiler();
    foreach ($alquileresSocio as $alquiler) {
        echo $alquiler->muestraResumen();
    }



    ?>


</body>

</html>
<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $soportes = $_SESSION["soportes"];
    $listaSoportes = "<ul>";
    foreach($soportes as $sopor){
        $listaSoportes .= "<li>".$sopor."</li>";
    }
    $listaSoportes .= "</ul>";

    $clientes = $_SESSION["clientes"];
    $listaClientes = "<ul>";
    foreach($clientes as $clien){
        $listaClientes .= "<li>".$clien."</li>";
    }
    $listaClientes .= "</ul>";


    if (!isset($_SESSION['admin'])) {
       die("Error - debe <a href='index.php'>identificarse</a>.<br />");
    }

    $datos = $_SESSION["datos"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de películas</title>
</head>
<body>
    <h1>Bienvenido <?= $_SESSION['admin'] ?></h1>
    <p>Pulse <a href="logout.php">aquí</a> para salir</p>


    <h2>Listado de Soportes</h2>
    <?=$listaSoportes?>

    <h2>Listado de Clientes</h2>
    <?=$listaClientes?>


    
</body>
</html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
$soportes = $_SESSION['soporte'];
$clientes = $_SESSION['cliente'];
// $usuarioLogeado=$_SESSION['usuarioLogeado']


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
    <?php
    foreach ($soportes as $soporte) {
        echo "<ul>";
        foreach ($soporte as $productos => $caracteristicas) {
            
            echo "<li>$productos : $caracteristicas</li>";
            
        }
        echo "</ul>";
    }


    ?>



    <h2>Listado de Clientes</h2>
    <?php
    foreach ($clientes as $cliente) {
        echo "<ul>";
        foreach ($cliente as $usuario => $caracteristicas) {
            if($usuario== "Contraseña"){
                echo "<li>$usuario : ***********</li>";
            }else{
                echo "<li>$usuario : $caracteristicas</li>";
            }
            
            
        }
        echo "</ul>";
    }


    ?>


</body>

</html>
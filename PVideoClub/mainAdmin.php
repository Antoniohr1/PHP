<?php
    if(!isset($_SESSION)) {
        session_start();
        
    }
    if (!isset($_SESSION['admin'])) {
       die("Error - debe <a href='index.php'>identificarse</a>.<br />");
    }
$datos = $_SESSION["datos"];
    include "$datos";
   // $usuarioLogeado=$_SESSION['usuarioLogeado']
   foreach($vc->getSocio() as $usu){
        $usuarioLogeado=[$usu->getUser()=>$usu->getPassword()];
}
    
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
    <?=$vc->listarProductos();?>

    <h2>Listado de Clientes</h2>
    <?=$vc->listarSocios();?>

    <h2>Usuario Logeado</h2>
    <?php
            foreach ($usuarioLogeado as $usu){
                echo "Usuario: ". $usu;
            }
    ?>
</body>
</html>
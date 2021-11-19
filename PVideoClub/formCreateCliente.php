<?php
if(!isset($_SESSION)) {
    session_start();
}
if (!isset($error)) {
    $error="";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
</head>
<body>
    <div><span class='error'><?php echo $error; ?></span></div>
    <form action='createCliente.php' method='post'>
            <label for='usuario'>Nombre:</label><br />
            <input type='text' name='nombre' id='nombre' maxlength="50" /><br />

            <label for='usuario'>Usuario:</label><br />
            <input type='text' name='formUsuario' id='usuario' maxlength="50" /><br />
            
            <label for='password'>Contraseña:</label><br />
            <input type='password' name='formPassword' id='password' maxlength="50" /><br />

            <input type='submit' name='enviar' value='Enviar' />
        </div>
    </form>
</body>
</html>
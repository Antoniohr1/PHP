<?php
spl_autoload_register( function( $nombreClase ) {
    $ruta = "app/".$nombreClase.'.php';
    $ruta = str_replace("\\","/",$ruta);
    include_once ("app/".$nombreClase.'.php');
} );


?>
<?php
namespace Dwes\ProyectoVideoclub;

spl_autoload_register( function( $nombreClase ) {
    include_once ("app/".$nombreClase.'.php');
} );


?>
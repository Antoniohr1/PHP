<?php

include "vendor/autoload.php";


use Dwes\ProyectoVideoclub\Util\VideoClubException;
use Dwes\ProyectoVideoclub\VideoClub;

$vc = new VideoClub("Severo 8A");

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("https://www.metacritic.com/game/playstation-4/god-of-war", "God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("https://www.metacritic.com/game/playstation-4/the-last-of-us-part-ii", "The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("https://www.metacritic.com/game/pc/torrente", "Torrente", 4.5, "es", "16:9");
$vc->incluirDvd("https://www.metacritic.com/movie/inception", "Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("https://www.metacritic.com/movie/star-wars-episode-v---the-empire-strikes-back", "El Imperio Contraataca", 3, "es,en", "16:9");
$vc->incluirCintaVideo("https://www.metacritic.com/movie/ghostbusters", "Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("https://www.metacritic.com/tv/the-name-of-the-rose", "El nombre de la Rosa", 1.5, 140);

//listo los productos 

//voy a crear algunos socios 

$vc->incluirSocio("Amancio Ortega", "amancio", "amancio");
$vc->incluirSocio("Pablo Picasso", "pablo", "pablo");

//$vc->alquilarSocioProducto(1,2)->alquilarSocioProducto(1,3)->alquilarSocioProducto(1,2)->alquilarSocioProducto(1,6); 
//alquilo otra vez el soporte 2 al socio 1. 
// no debe dejarme porque ya lo tiene alquilado 
//$vc->alquilarSocioProducto(1,2); 
//alquilo el soporte 6 al socio 1. 
//no se puede porque el socio 1 tiene 2 alquileres como máximo 
//$vc->alquilarSocioProducto(1,6); 

//listo los socios 


try {
    $vc->alquilarSocioProductos(0, [0, 2, 4]);
    $vc->alquilarSocioProductos(1, [1, 3, 5]);
} catch (VideoClubException $e) {
    echo $e->getMessage();
}


/*try{
    $vc->devolverSocioProducto(1,3);
    }catch(VideoClubException $e){
        echo $e->getMessage();
    }
    
    try{
        $vc->devolverSocioProductos(0,[0,2,4]);
        }catch(VideoClubException $e){
            echo $e->getMessage();
        }
        
?>*/
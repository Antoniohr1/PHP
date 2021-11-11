<?php
declare(strict_types=1);
namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\ClientNoEncontradoException;
class VideoClub{
        private array $productos;
        private int $numProductos=0;
        private array $socios;
        private int $numSocios=0;
        private int $numProductosAlquilado;
        private int $numTotalAlquileres;

    public function __construct(
        private string $nombre,
    ){
        $this->productos=[];
        $this->socios=[];
    }
    public function getSocio(): array {
        return $this->socios;
    }
    public function getNumTotalAlquileres(): int {
        return $this->numTotalAlquileres;
    }
    public function getNumProductosAlquilados(): int {
        return $this->numProductosAlquilado;
    }

    private function incluirProducto(Soporte $s){
        //array_push($this->productos, $s);
        $this->productos[$this->numProductos]=$s;
        //echo "Incluido soporte ".$this->numProductos. "<br>";
        $this->numProductos++;
    }

    public function incluirCintaVideo(string $titulo, float $precio, int $duracion){
        $cintaVideo = new CintaVideo($titulo,$this->numProductos,$precio,$duracion);
        $this->incluirProducto($cintaVideo);
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla){
        $DVD = new Dvd($titulo,$this->numProductos,$precio,$idiomas,$pantalla);
        $this->incluirProducto($DVD);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minJ, int $maxJ){
        $juego = new Juego($titulo,$this->numProductos,$precio,$consola,$minJ, $maxJ);
        $this->incluirProducto($juego);
    }

    public function incluirSocio(string $nombre, string $user, string $password, int $maxAlquileresConsurrentes=3){
        $socio = new Cliente($nombre,$this->numSocios,$user,$password ,$maxAlquileresConsurrentes);
        //array_push($this->socios, $socio);
        $this->socios[$this->numSocios]=$socio;
       // echo "<br>";
        //echo "Incluido Socio " . $this->numSocios. "<br>";
        $this->numSocios++;
    }

    public function listarProductos(){
        $contador=1;
        
        echo "Listado de los ".$this->numProductos." productos disponibles<br>";
        foreach($this->productos as $producto){
            echo $contador.".- ";
            echo $producto->muestraResumen();
            echo "<br>";
            $contador++;
        }
    }

    public function listarSocios(){
        $contador=1;
  
        echo "Listado de ".$this->numSocios." socios del videoclub<br>";
        foreach($this->socios as $socio){
            echo $contador.".- ";
            echo $socio->muestraResumen();
            echo "<br>";
            $contador++;
        }

    }

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte){
        $soporte = $this->productos[$numeroSoporte];
        if (!isset($soporte)){
            throw new SoporteNoEncontradoException("El soporte ". $this->numeroSoporte. " no se encuentra disponible");
        }
        $cliente = $this->socios[$numeroCliente];
        if (!isset($cliente)){
            throw new ClientNoEncontradoException("El cliente ". $this->numeroCliente. " no se encuentra disponible");
        }
        
        try{
            $cliente->alquilar($soporte); 
        }catch(SoporteYaAlquiladoException | CupoSuperadoException $e){
            echo "<br>Se ha producido un error: <br>".$e->getMessage();
        }
       
        return $this;
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProducto){
        $cliente = $this->socios[$numSocio];
        if (!isset($cliente)){
            throw new ClientNoEncontradoException("El cliente ". $this->numeroCliente. " no se encuentra disponible");
        }

        foreach($numerosProducto as $numero){
            $soporte = $this->productos[$numero];

            if (!isset($soporte)){
            throw new SoporteNoEncontradoException("El soporte ". $numero. " no se encuentra disponible.No se puede hacer la devolución");
            }
        }

        foreach($numerosProducto as $numero){
            $this->alquilarSocioProducto($numSocio,$numero);
        }
    }


    public function devolverSocioProducto(int $numSocio, int $numeroProducto){
        $soporte = $this->productos[$numeroProducto];
        if (!isset($soporte)){
            throw new SoporteNoEncontradoException("El soporte ". $this->numeroProducto. " no se encuentra disponible");
        }
        $cliente = $this->socios[$numSocio];
        if (!isset($cliente)){
            throw new ClientNoEncontradoException("El cliente ". $this->numSocio. " no se encuentra disponible");
        }
        
        try{
            $cliente->devolver($numeroProducto); 
        }catch(SoporteYaAlquiladoException | ClientNoEncontradoException $e){
            echo "<br>Se ha producido un error: <br>".$e->getMessage();
        }
       
        return $this;
    }


    public function devolverSocioProductos(int $numSocio, array $numerosProductos){
        $cliente = $this->socios[$numSocio];
        if (!isset($cliente)){
            throw new ClientNoEncontradoException("El cliente ". $this->numeroCliente. " no se encuentra disponible");
        }

        foreach($numerosProductos as $numero){
            $soporte = $this->productos[$numero];

            if (!isset($soporte)){
            throw new SoporteNoEncontradoException("El soporte ". $numero. " no se encuentra disponible.No se puede hacer la devolución");
            }
        }

        foreach($numerosProductos as $numero){
            $this->devolverSocioProducto($numSocio,$numero);
        }
        
        return $this;
    }
}






?>
<?php
declare(strict_types=1);
include_once "Soporte.php";
include_once "Cliente.php";
include_once "Juego.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
class VideoClub{
        private array $productos;
        private int $numProductos=0;
        private array $socios;
        private int $numSocios=0;

    public function __construct(
        private string $nombre,
    ){
        $this->productos=[];
        $this->socios=[];
    }

    private function incluirProducto(Soporte $s){
        array_push($this->productos, $s);
        echo "Incluido soporte ".$this->numProductos. "<br>";
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

    public function incluirSocio(string $nombre, int $maxAlquileresConsurrentes=3){
        $socio = new Cliente($nombre,$this->numSocios, $maxAlquileresConsurrentes);
        array_push($this->socios, $socio);
        echo "<br>";
        echo "Incluido Socio " . $this->numSocios. "<br>";
        $this->numSocios++;
    }

    public function listarProductos(){
        $contador=1;
        echo "<br><br>";
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
        echo "<br><br>";
        echo "Listado de ".$this->numSocios." socios del videoclub<br>";
        foreach($this->socios as $socio){
            echo $contador.".- ";
            echo $socio->muestraResumen();
            echo "<br>";
            $contador++;
        }

    }

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte){
        $cliente = $this->socios[$numeroCliente];
        $soporte = $this->productos[$numeroSoporte];
        $cliente->alquilar($soporte);
    }


}






?>
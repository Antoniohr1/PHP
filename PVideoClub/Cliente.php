<?php
declare(strict_types=1);
include_once("Soporte.php");
class Cliente{
        private array $soporteAlquilado=[];
        private int $numSoporteAlquilado;
        
    public function __construct(
        public string $nombre,
        private int $numero, 
        private int $maxAlquilerConcurente=3
    ){}
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero(int $numero){
        $this->numero = $numero;
    }
    public function getNumSoporteAlquilado(){
        return $this->numSoporteAlquilado;
    }
    public function mostrarResumen(){
        echo "<br>Nombre: ". $this->nombre. "<br> Cantidad de Alquileres: ". count($this->soporteAlquilado);
    }
    public function tieneAlquilado(Soporte $s): bool{
        $resultado = false;
        foreach($this->soporteAlquilado as $soporte){
            if ($soporte instanceof $s){
                $resultado=true;
            }
        }
        return $resultado;
    }
}
?>
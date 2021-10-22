<?php
class Cliente{

    public function __construct(
        public string $nombre,
        private int $numero,
        private array $soporteAlquilado,
        private int $numSoporteAlquilado,
        private int $maxAlquilerConcurente=3
    ){
        $this->soporteAlquilado=[];
    }
}
?>
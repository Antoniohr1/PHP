<?php

declare(strict_types=1);
namespace Dwes\ProyectoVideoclub;




class Juego extends Soporte
{

    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        public string $consola,
        private int $minNumJugadores,
        private int $maxNumJugadores
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraJugadoresPosibles(): string
    {
        $resultado = "";

        if ($this->minNumJugadores == 1 && $this->maxNumJugadores == 1) {
            $resultado = "Para un jugador";
        } elseif ($this->minNumJugadores >= 0 && $this->maxNumJugadores == 0) {
            $resultado = "Para " . $this->minNumJugadores . " jugadores";
        } else {
            $resultado = "De " . $this->minNumJugadores . " a " . $this->maxNumJugadores . " jugadores";
        }

        return $resultado;
    }

    public function muestraResumen()
    {
        echo "Juego para: " . $this->consola;
        parent::muestraResumen();
        echo "<br>" . $this->muestraJugadoresPosibles();
    }
}

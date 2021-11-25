<?php

declare(strict_types=1);
namespace Dwes\ProyectoVideoclub;
class Juego extends Soporte
{

    public function __construct(
        string $metacritic,
        string $titulo,
        int $numero,
        float $precio,
        public string $consola,
        private int $minNumJugadores,
        private int $maxNumJugadores
    ) {
        parent::__construct($metacritic,$titulo, $numero, $precio);
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
        echo "<br>";
        parent::muestraResumen();
        echo "<br>" . $this->muestraJugadoresPosibles();
    }

    public function getPuntuacion()
    {
        require 'vendor/autoload.php';

        $httpClient = new \Goutte\Client();
        $response = $httpClient->request('GET', $this->metacritic);
        $puntuacion = [];

        $response->filter("a.metascore_anchor  span[itemprop='ratingValue']")->each(
            // le pasamos $precios por referencia para poder editarla dentro del closure
            function ($node) use (&$puntuacion) {
                $puntuacion[] = $node->text();
            }
        );
        foreach($puntuacion as $punt){
            echo "Puntuación metacritic: ". $punt."<br>";
        }
    }
}

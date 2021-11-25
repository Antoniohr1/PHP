<?php

declare(strict_types=1);
namespace Dwes\ProyectoVideoclub;




class CintaVideo extends Soporte
{

    public function __construct(
        string $metacritic,
        string $titulo,
        int $numero,
        float $precio,
        private int $duracion
    ) {
        parent::__construct($metacritic,$titulo, $numero, $precio);
    }


    public function muestraResumen()
    {
        echo "Película en VHS: ";
        parent::muestraResumen();
        echo "<br>Duración: " . $this->duracion . " minutos";
    }

    public function getPuntuacion()
    {
        require 'vendor/autoload.php';

        $httpClient = new \Goutte\Client();
        $response = $httpClient->request('GET', $this->metacritic);
        $puntuacion = [];

        $response->filter("a.metascore_anchor span.metascore_w.larger.movie.positive")->each(
            // le pasamos $precios por referencia para poder editarla dentro del closure
            function ($node) use (&$puntuacion) {
                $puntuacion[] = $node->text();
            }
        );
            echo "Puntuación metacritic: ". $puntuacion[0]."<br>";
    }
}

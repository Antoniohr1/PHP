<?php

declare(strict_types=1);
namespace app\Dwes\ProyectoVideoclub;

include("autoload.php");
use app\Dwes\ProyectoVideoclub\Soporte;

class CintaVideo extends Soporte
{

    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        private int $duracion
    ) {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraResumen()
    {
        echo "Película en VHS: ";
        parent::muestraResumen();
        echo "<br>Duración: " . $this->duracion . " minutos";
    }
}

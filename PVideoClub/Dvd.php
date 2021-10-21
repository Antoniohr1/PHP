<?php

declare(strict_types=1);

include_once "Soporte.php";

class Dvd extends Soporte
{

    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        public string $idiomas,
        private string $formatPantalla
    ) {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraResumen()
    {
        echo "<br> Película en DVD: ";
        parent::muestraResumen();
        echo "<br>Idiomas : " . $this->idiomas;
        echo "<br>Formato Pantalla: " . $this->formatPantalla;
    }
}

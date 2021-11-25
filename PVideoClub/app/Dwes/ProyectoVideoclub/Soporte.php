<?php

declare(strict_types=1);

namespace Dwes\ProyectoVideoclub;

 abstract class Soporte implements Resumible
{

    const IVA = 1.21;
    
    public function __construct(
        public string $metacritic,
        public string $titulo,
        protected int $numero,
        private float $precio,
        public $alquilado= false
    ) {
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getPrecioConIva(): float
    {
        return $this->precio * self::IVA;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function muestraResumen()
    {
        echo "<i>" . $this->titulo . "</i>";
        echo "<br>" . $this->precio . " (IVA no incluido)";
    }

    public abstract function getPuntuacion();
}

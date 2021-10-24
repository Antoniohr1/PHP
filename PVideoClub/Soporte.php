<?php

declare(strict_types=1);

abstract class Soporte 
{

    const IVA = 1.21;

    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio
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
}

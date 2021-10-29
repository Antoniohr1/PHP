<?php

declare(strict_types=1);

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

class Cliente
{
    private array $soporteAlquilado = [];
    private int $numSoporteAlquilado = 0;

    public function __construct(
        public string $nombre,
        private int $numero,
        private int $maxAlquilerConcurente = 3
    ) {
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero(int $numero)
    {
        $this->numero = $numero;
    }
    public function getNumSoporteAlquilado()
    {
        return $this->numSoporteAlquilado;
    }
    public function muestraResumen()
    {
        echo "Nombre: " . $this->nombre . "<br> Cantidad de Alquileres: " . count($this->soporteAlquilado);
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        $resultado = false;
        if (in_array($s, $this->soporteAlquilado)) {
            $resultado = true;
        }

        return $resultado;

        //isset($this->soporteAlquilado[$s->getNumero()]);
    }

    public function alquilar(Soporte $s)
    {
        if ($this->tieneAlquilado($s)) {
            throw new SoporteYaAlquiladoException("<br><br>El cliente ya tiene alquilado el soporte" . $s->titulo);
        } else if ($this->maxAlquilerConcurente == $this->numSoporteAlquilado) {
            throw new CupoSuperadoException("<br><br>Este cliente tiene " . $this->maxAlquilerConcurente . " elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo");
        } else {
            $this->numSoporteAlquilado++;
            //$this->soporteAlquilado[$s->getNumero()]=$s;
            //array_push($this->soporteAlquilado, $s);
            $this->soporteAlquilado[$s->getNumero()]=$s;
            $s->alquilado = true;
            echo "<br><br>Alquilado soporte a " . $this->nombre;
            echo "<br><br><br>";
            $s->muestraResumen();
        }



        return $this;
    }

    public function devolver(int $numSoporte): bool
    {
        $resultado = false;
        foreach ($this->soporteAlquilado as $indice=>$soporte) {
            if ($indice == $numSoporte) {
                $resultado = true;
                unset($this->soporteAlquilado[$numSoporte]);
                $soporte->alquilado = false;
            }
        }

        if ($resultado == false) {
            throw new SoporteNoEncontradoException("<br>El soporte " . $numSoporte . " no se encuentra disponible");
        } else {
            $this->numSoporteAlquilado--;
            echo "<br><br>El cliente ha devuelto el soporte número " . $numSoporte . ". Actualmente tiene " . $this->numSoporteAlquilado . " soportes alquilados";
        }
        return $resultado;
    }

    public function listarAlquileres(): void
    {
        if ($this->getNumSoporteAlquilado() == 0) {
            echo "Este cliente no tiene alquilado ningún elemento";
        } else {
            echo "<br><br>El cliente tiene " . $this->getNumSoporteAlquilado() . " soportes alquilados<br><br>";
            foreach ($this->soporteAlquilado as $soporte) {
                $soporte->muestraResumen();
                echo "<br><br>";
            }
        }
    }
}

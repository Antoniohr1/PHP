<?php

declare(strict_types=1);

namespace Dwes\ProyectoVideoclub;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\IntrospectionProcessor;
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

class Cliente
{
    private array $soporteAlquilado = [];
    private int $numSoporteAlquilado = 0;
    private Logger $miLog;
    public function __construct(
        public string $nombre,
        private int $numero,
        private string $user,
        private string $password,
        private int $maxAlquilerConcurente
    ) {
        $this->miLog = new Logger("Logger");
        $this->miLog->pushHandler(new RotatingFileHandler("VideoclubLogger/ClienteLogs/videoclub.log", 1, Logger::DEBUG));
        $this->miLog->pushProcessor(new IntrospectionProcessor());
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPassword()
    {
        return $this->password;
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
        echo "Nombre: " . $this->nombre . "<br> Cantidad de Alquileres: " . count($this->soporteAlquilado) . "<br> Usuario" . $this->user;
    }
    public function muestraUsuario()
    {
        //$this->miLog->info("<br>Usuario : " . $this->user);
        echo "<br>Usuario : ".$this->user;
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
            $this->miLog->warning("El cliente ya tiene alquilado el soporte", [$s->titulo]);
            throw new SoporteYaAlquiladoException("<br><br>El cliente ya tiene alquilado el soporte" . $s->titulo);
        } else if ($this->maxAlquilerConcurente == $this->numSoporteAlquilado) {
            $this->miLog->warning("Este cliente ha alcanzado el maximo de alquileres", [$this->maxAlquilerConcurente]);
            throw new CupoSuperadoException("<br><br>Este cliente tiene " . $this->maxAlquilerConcurente . " elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo");
        } else {
            $this->numSoporteAlquilado++;
            //$this->soporteAlquilado[$s->getNumero()]=$s;
            //array_push($this->soporteAlquilado, $s);
            $this->soporteAlquilado[$s->getNumero()] = $s;
            $s->alquilado = true;
            /* echo "<br><br>Alquilado soporte a " . $this->nombre;
            echo "<br><br><br>";
            $s->muestraResumen();*/
        }



        return $this;
    }

    public function devolver(int $numSoporte): bool
    {
        $resultado = false;
        foreach ($this->soporteAlquilado as $indice => $soporte) {
            if ($indice == $numSoporte) {
                $resultado = true;
                unset($this->soporteAlquilado[$numSoporte]);
                $soporte->alquilado = false;
            }
        }

        if ($resultado == false) {
            $this->miLog->warning("El soporte no se encuentra disponible", [$numSoporte]);
            throw new SoporteNoEncontradoException("<br>El soporte " . $numSoporte . " no se encuentra disponible");
        } else {
            $this->numSoporteAlquilado--;
            $this->miLog->info("El cliente ha devuelto el soporte número " . $numSoporte . ". Actualmente tiene " . $this->numSoporteAlquilado . " soportes alquilados");
            //echo "<br><br>El cliente ha devuelto el soporte número " . $numSoporte . ". Actualmente tiene " . $this->numSoporteAlquilado . " soportes alquilados";
        }
        return $resultado;
    }

    public function listarAlquileres(): void
    {
        if ($this->getNumSoporteAlquilado() == 0) {
            $this->miLog->info("Este cliente no tiene alquilado ningún elemento");
            //echo "Este cliente no tiene alquilado ningún elemento";
        } else {
            $this->miLog->info("El cliente tiene " . $this->getNumSoporteAlquilado() . " soportes alquilados<br><br>");
            //echo "<br><br>El cliente tiene " . $this->getNumSoporteAlquilado() . " soportes alquilados<br><br>";
            foreach ($this->soporteAlquilado as $soporte) {
                $soporte->muestraResumen();
                echo "<br><br>";
            }
        }
    }
    public function getAlquiler(): array
    {
        return $this->soporteAlquilado;
    }
}

<?php

class Perro extends Animalito
{
    private $nombre;
    private $fechaNac;
    private $peso;
    private $raza;

    public function __construct($nombre, $fechaNac, 
    $peso, $raza)
    {
        $this->nombre = $nombre;
        $this->fechaNac = $fechaNac;
        $this->peso = $peso;
        $this->raza = $raza;
    }

    public function GetNombre()
    {
        return $this->nombre;
    }

    public function GetFechaNac()
    {
        return $this->fechaNac;
    }

    public function GetPeso()
    {
        return $this->peso;
    }

    public function GetRaza()
    {
        return $this->raza;
    }
}

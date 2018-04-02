<?php
class Animal implements IMostrable
{
    private $nombre;
    private $tipoAnimal;
    private $edad;
    private $raza;

    public function __construct($nombre, $tipoAnimal, $edad, $raza)
    {
        $this->nombre = $nombre;
        $this->tipoAnimal = $nombre;
        $this->edad = $edad;
        $this->raza = $raza;
    }

    public function DoHtml()
    {
        $retorno = "<label><h3>Nombre: " . $this->nombre . "</h3></label><br>";
        $retorno = $retorno . "<label><h3>Tipo de animal: " . $this->tipoAnimal . "</h3></label><br>";
        $retorno = $retorno . "<label><h3>Edad: " . $this->edad . "</h3></label><br>";
        $retorno = $retorno . "<label><h3>Raza: " . $this->raza . "</h3></label><br>";
        return $retorno;
    }

    public function __toString()
    {
        return $this->DoHtml();
    }

    /**
     * @return mixed $nombre
     */
    public function Getnombre()
    {
        return $this->nombre;
    }

	/**
     * @param mixed 
     */
    public function SetNombre($valor)
    {
        $this->nombre = $valor;
    }

    public function __Get($prop)
    {
        if (property_exists(get_class(), $prop)) {
            return $this->$prop;
        } else {
            return "Wea";
        }

    }

    public function __Set($prop, $valor)
    {
        if (property_exists(get_class(), $prop)) {
            $this->prop = $valor;
        }

    }

}

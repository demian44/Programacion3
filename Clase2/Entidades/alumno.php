<?php
 
class Alumno extends Persona{

    private $legajo;
    private $E_Inscripcion;

    public function __construct($nombre_, $apellido_, $dni_,$direccion_,$legajo_, $E_Inscripcion){
        parent::__construct($nombre_, $apellido_, $dni_,$direccion_);
        $this->legajo = $legajo_;
        $this->E_Inscripcion = $E_Inscripcion;
    }

    public function __toString(){
        $retorno = "<h3>Alumno:</h3><br>".parent::__toString();
        $retorno =  $retorno."<div><label><h4>Legajo: ".$this->legajo;
        $retorno =  $retorno."<div><label><h4>Inscripción: ".$this->E_Inscripcion;

        return $retorno;
    }
}

?>
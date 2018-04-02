<?php
 
class Profesor extends Persona{

    private $materias;
    private $dias;

    public function __construct($nombre_, $apellido_, $dni_,$direccion_,$materias, $dias){
        parent::__construct($nombre_, $apellido_, $dni_,$direccion_);
        $this->materias = $materias;
        $this->dias = $dias;
       // var_dump($this->materias);
    }

    function __toString(){
        $retorno = "<h3>Profesor:</h3><br>".parent::__toString();
        $retorno =  $retorno."<div><label><h4>materias: ";
       
        foreach($this->materias as $materia){
            $retorno =  $retorno."<label><h4> - ".$materia."<h4>";
        }

        $retorno =  $retorno."<div><label><h4>Días: ";
        foreach($this->dias as $dia){
            $retorno =  $retorno."<label><h4> - ".$dia."<h4>";
        }

        
        return $retorno;
    }
}

?>
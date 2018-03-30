<?php
 
abstract class Persona implements IMostrable{

    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;

    public function SetNombre($nombre_){
        $this->nombre = $nombre_;
    }

    public function GetNombre(){
        return $this->nombre;
    }

    public function SetApellido($apellido_){
        $this->apellido = $apellido_;
    }
    
    public function GetApellido(){
        return $this->apellido;
    }

    public function SetDni($dni_){
        $this->dni = $dni_;
    }

    public function GetDni(){
        return $this->dni;
    }
    

    public function SetDireccion($direccion_){
        $this->$direccion = $direccion_;
    }

    public function GetDireccion(){
        return $this->$direccion;
    }

    public function __Set($prop, $valor){
        $this->$prop = '$valor';
    }

    public function __Get($prop){
        return $this->$prop;
    }

    function __construct(  $nombre_, $apellido_, $dni_,$direccion_){
        $this->nombre = $nombre_;
        $this->apellido = $apellido_;
        $this->dni = $dni_;
        $this->direccion = $direccion_;
    }

    function __toString(){
        return $this->DoHtml();
    }

    public function DoHtml(){
        $retorno = "<h3>Datos: </h3><div><label><h4>Nombre: ".$this->nombre."</h4></label></div>";
        $retorno = $retorno."<div><label><h4>Apellido: ".$this->apellido."</h4></label></div>";
        $retorno = $retorno."<div><label><h4>DNI: ".$this->dni."</h4></label></div>";
        $retorno = $retorno.$this->direccion->DoHtml();
        
        return $retorno;
    }

}

?>
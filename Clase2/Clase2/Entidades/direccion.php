<?php




class Direccion implements IMostrable{

    private $calle;
    private $altura;
    private $localidad;

    public function SetCalle($calle_){
        $this->calle = $calle_;
    }

    public  function GetCalle(){
        return $this->calle;
    }


    public  function SetAltura($altura_){
        $this->altura = $altura_;
    }

    public  function GetAltura(){
        return $this->altura;
    }


    public  function SetLocalidad($Localidad_){
        $this->localidad = $localidad_;
    }

    public  function GetLocalidad(){
        return $this->localidad;
    }

    function __construct($calle_, $altura_, $localidad_){
        $this->calle = $calle_;
        $this->altura = $altura_;
        $this->localidad = $localidad_;
    }
    
    public function DoHtml(){
        $retorno = "<h3>Direccion: </h3><div><label><h4>CP: ".$this->calle."</h4></label></div>";
        $retorno = $retorno."<div><label><h4>Altura: ".$this->altura."</h4></label></div>";
        $retorno = $retorno.$this->localidad->DoHtml();
        return $retorno;
    }
    

}

?>


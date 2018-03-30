<?php


class Localidad implements IMostrable{

    private $cp;
    private $nombre;

        function   __construct($cp_, $nombre_){
            $this->cp = $cp_;
            $this->nombre = $nombre_;
    }


    public function SetCp($cp_){
        $this->cp = $Cp_;
    }

    public function GetCp($cp_){
        return $this->cp;
    }

    public function SetAltura($altura_){
        $this->altura = $altura_;
    }

    public function GetAltura($altura_){
        return $this->altura;
    }
    
    public function DoHtml(){
        $retorno = "<h3>Datos de la localidad: </h3><div><label><h4>CP: ".$this->cp."</h4></label></div>";
        $retorno = $retorno."<div><label><h4>Nombre: ".$this->nombre."</h4></label></div>";
        return $retorno;
    }

}

?>
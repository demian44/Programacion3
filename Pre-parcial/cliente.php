<?php
class Cliente
{

    public $name;
    public $clave;
    public $correo;
    private $fileName = "./clientes/clientesActuales.txt";
    /////////////CONSTRUCTOR//
    public function __construct($name, $clave, $correo)
    {
        $this->name = $name;
        $this->clave = $clave;
        $this->correo = $correo;
    }

    /////////////MÉTODOS MÁGICOS//
    public function __toString()
    {
        return "$this->name-$this->clave-$this->correo";
    }
    public function GuardarEnArchivo()
    {
        $return = false;
        if (strlen($this) > 0) {
            $file = fopen($this->fileName, "a");
            fwrite($file, $this . PHP_EOL);
            fclose($file);
            $return = true;
        }
        return $return;
    }
    public function Validar()
    {
        $return = false;
        $file = fopen($this->fileName, "r");
        while (!feof($file)) {
            $cliente = fgets($file);
            $arrayStringCliente = explode("-", $cliente);
            if (count($arrayStringCliente) == 3)
                if ($arrayStringCliente[1] == $this->correo && $arrayStringCliente[2] == $this->clave) {
                $return = true;
                break;
            }

        }   
        fclose($file);

        return $return;
    }

}
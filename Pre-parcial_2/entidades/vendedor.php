<?php 
class Vendedor
{
    public $nombre;
    public $fecha;
    public $clave;
    public $foto;


    public function __construct($nombre, $fecha, $clave)
    {
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->clave = $clave;
        $this->foto = "Sin foto";
    }

    public function __toString()
    {
        return "$this->nombre-$this->fecha-$this->clave-$this->foto";
    }

    public function GuardarEnArchivo()
    {
        $return = false;
        $path = "./vendedores/vendedores_Actuals.txt";
        $file = new Manejador_Archivos();
        $this->guardarFoto();
        if($file->writeLine($path, $this)){
            $return = true;
        }


        return $return;
    }

    function guardarFoto()
    {
        if ($_FILES["foto"]["error"] == 0) {
            $manejadorArchivos = new Manejador_Archivos();
            $type = explode("/", $_FILES["foto"]["type"]); // Saco el tipo
            $manejadorArchivos->guardarFoto(
                $this->foto,
                $this->nombre,
                "./fotoVendedores/"
            );
        }
    }


    public static function Validar($clave, &$nombre)
    {
        $path = "./vendedores/vendedores_Actuals.txt";
        $fileManager = new Manejador_Archivos();
        $existe = false;
        if ($fileManager->read($path, $file))//Si enguentra un archivo
            while (!feof($file)) {
            $lineaArchivo = fgets($file);
            $arrayValores = explode("-", $lineaArchivo);
            if (count($arrayValores) == 3) // Si son tres campos entra
                if ($arrayValores[1] == $clave) { // Si coincide la clave entra y rompe el while
                $nombre = $arrayValores[0];
                $existe = true;
                break;
            }

        }
        return $existe;
    }

}


?>
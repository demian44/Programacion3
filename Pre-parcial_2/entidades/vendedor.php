<?php 
class Vendedor
{
    public $nombre;
    public $fecha;
    public $clave;
    private $foto;

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
    public function SetFoto($foto)
    {
        $this->foto = $foto;
    }
    public function GuardarEnArchivo()
    {
        $return = false;
        $path = "./vendedores/vendedores_Actuals.txt";
        $file = new Manejador_Archivos();
        $this->guardarFoto();
        if ($file->writeLine($path, $this)) {
            $return = true;
        }


        return $return;
    }

    public function Modificar()
    {

        $arrayVendedores;
        if (self::TraerVendedores($arrayVendedores)) {
            $fileManager = new Manejador_Archivos();
            $string = "";

            foreach ($arrayVendedores as $key => $vendedor) {



                if ($vendedor->clave == $this->clave) {
                    echo "$vendedor->foto";
                    if (isset($_FILES["foto"])) {
                        if ($vendedor->foto != "Sin foto") {
                            self::Backup($vendedor->foto);
                        }

                        $this->guardarFoto();
                    }
                    $string .= $this . PHP_EOL;
                } else
                    $string .= $vendedor . PHP_EOL;
            }

            $fileManager->WritteFile("./vendedores/vendedores_Actuals.txt", $string);
            return true;
        }
        return false;
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

    public static function Backup($file)
    {
        echo "backup";
        $manejadorArchivos = new Manejador_Archivos();
        $fileName = explode("/", $file);
        $nameFile = trim($fileName[count($fileName) - 1]);
        $arrayFileName = explode(".", $nameFile);
        $manejadorArchivos->BackupFoto(
            $file,
            "./fotoVendedores/",
            $arrayFileName[0] . ".eliminado." . $arrayFileName[1]
        );
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

    public static function TraerVendedores(&$arrayVendedores)
    {
        $arrayVendedores = [];
        $lector = new Manejador_Archivos();
        $file;#
        if ($lector->read("./vendedores/vendedores_Actuals.txt", $file)) {
            while (!feof($file)) {
                $linea = trim(fgets($file));
                $datos = explode("-", $linea);
                if (count($datos) == 4) {
                    $vendedor = new Vendedor($datos[0], $datos[1], $datos[2]);
                    $vendedor->foto = $datos[3];
                    var_dump($vendedor);
                    array_push($arrayVendedores, $vendedor);
                }
            }
            fclose($file);
            return true;
        } else
            return false;
    }
}

?>
<?php
class Helado_ implements IVendible_
{
    private $sabor;
    private $precio;
    private $foto;

    function __construct($sabor, $precio/*,$foto)*/ )
    {
        $this->sabor = $sabor;
        $this->precio = $precio;            
        $this->foto = "Sin foto";
    }

    public function __toString()
    {
        return "$this->sabor-$this->precio-$this->foto";
    }

    public function Guardar()
    {
        $this->guardarFoto();
        $file = new Manejador_Archivos();
        $file->writeLine("./heldaos/sabores.txt", $this);
    }

    function guardarFoto()
    {
        if ($_FILES["foto"]["error"] == 0) {
            $manejadorArchivos = new Manejador_Archivos();
            $type = explode("/", $_FILES["foto"]["type"]); // Saco el tipo
            $manejadorArchivos->guardarFoto(
                $this->foto,
                $this->sabor . "." . date("h") . date("i") . date("s"),
                "./heladosImagen/"
            );
        }
    }

    function PrecioMasIva()
    {
        $return = $this->precio * 1.21; //4
        return $return;
    }

    public static function Vender($sabor, $cantidad, &$precio)
    {
        $return = false;
        $manejadorArch = new Manejador_Archivos();
        $file;
        if ($manejadorArch->read("./heldaos/sabores.txt", $file)) {
            while (!feof($file)) {
                $lineaLeida = fgets($file);
                $datos = explode("-", $lineaLeida);
                if (trim($datos[0]) == $sabor) {
                    fclose($file);//Cierro el archivo.
                    $helado = new Helado_($datos[0], $datos[1]);
                    $precio = $helado->PrecioMasIva() * $cantidad;
                    $manejadorArch->writeLine("./heldaos/vendidos.txt", $datos[0] . "-$" . $precio . "-" . $cantidad . " kg");
                    $return = true;
                    break;
                }
            }
        }
        return $return;
    }

    public static function TraerHelados(&$arrayHelados)
    {
        $arrayHelados = [];
        $lector = new Manejador_Archivos();
        $file;#
        if ($lector->read("./heldaos/sabores.txt", $file)) {
            while (!feof($file)) {
                $linea = trim(fgets($file));
                $datos = explode("-", $linea);
                if (count($datos) == 3) {
                    $helado = new Helado_($datos[0], $datos[1]);
                    $helado->SetFoto($datos[2]);
                    array_push($arrayHelados, $helado);
                }
            }
            fclose($file);
            return true;
        }
        else 
        return false;
    }

    public static function HacerTabla()
    {
        $helados;
        echo "entró";
        self::TraerHelados($helados);
        $tabla = "<table border=1><thead><tr><th>Sabor</th><th>Precio</th><th>Foto</th></tr></thead><tbody>";
        foreach ($helados as $key => $helado) {
            $fotoArray = explode("/", trim($helado->foto));
            $foto = $fotoArray[count($fotoArray) - 1];
            $tabla .= "<tr><td>$helado->sabor</td><td>$helado->precio</td><td><img 
            src='http://localhost:8080/Programacion3/Pre-parcial_2/heladosImagen/$foto'
            style='height:150px;' srcset=''></td></tr>";
        }
        $tabla .= "</tbody></table>";
        echo $tabla;
    }

    public function SetFoto($foto)
    {
        if (!is_null($foto) && $foto != "")
            $this->foto = $foto;
    }

    public static function Backup($file)
    {
        $manejadorArchivos = new Manejador_Archivos();
        $fileName = explode("/", $file);
        $nameFile = trim($fileName[count($fileName) - 1]);
        $arrayFileName = explode(".",$nameFile);
        $manejadorArchivos->BackupFoto(
            $file,
            "./heladosBorrados/", 
            $arrayFileName[0].".eliminado.".$arrayFileName[1].".".$arrayFileName[2]
            );
    }

    public static function ExisteElado($sabor)
    {
        $arrayHelados;
        if (self::TraerHelados($arrayHelados)) {
            foreach ($arrayHelados as $key => $helado) {
                
                if ($helado->sabor == $sabor){
                    
                    return true;
                }
            }
        }
        return false;
    }

    public static function EliminarHelado($sabor)
    {      
        $arrayHelados;
        if (self::TraerHelados($arrayHelados)) {
            $fileManager = new Manejador_Archivos();
            $string = "";
            
            foreach ($arrayHelados as $key => $helado) {
                if ($helado->sabor == $sabor){
                    self::Backup($helado->foto);
                    //unset($arrayHelados,$key);
                }
                else
                    $string .= $helado.PHP_EOL;
                    
            }
            
            $fileManager->WritteFile("./heldaos/sabores.txt",$string );
            return true;
        }
        return false;
    }


    public function ModificarHelado(){
        $arrayHelados;
        if (self::TraerHelados($arrayHelados)) {
            $fileManager = new Manejador_Archivos();
            $string = "";
            
            foreach ($arrayHelados as $key => $helado) {
                if ($helado->sabor == $this->sabor){
                    if(isset($_FILES["foto"])){
                        self::Backup($helado->foto);
                        $this->guardarFoto();
                    }
                    $string .= $this.PHP_EOL;
                }
                else 
                    $string.= $helado.PHP_EOL;
            }
            
            $fileManager->WritteFile("./heldaos/sabores.txt",$string );
            return true;
        }
        return false;
    }
}

?>
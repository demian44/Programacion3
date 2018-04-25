<?php
class Helado implements IVendible
{

    private $sabor;
    private $precio;
    private $foto;
    private $fileName = "./helados/sabores.txt";
    //./heladosImagen/
    /////////////CONSTRUCTOR//
    public function __construct($sabor, $precio)
    {
        $this->sabor = $sabor;
        $this->precio = $precio;
    }

    public function __toString()
    {
        return "$this->sabor-$this->precio-$this->foto";
    }

    public function GuardarHelado()
    {
        $return = false;
        if ($_FILES["foto"]["error"] == 0) {
            $type = explode("/", $_FILES["foto"]["type"]);
            $name = $this->sabor . "." . date("h") . date("i") . date("s") . "." . $type[1];
            move_uploaded_file($_FILES["foto"]["tmp_name"], "./heladosImagen/" . $name);
            $this->foto = "./heladosImagen/" . $name;
        }
        if (strlen($this) > 0) {
            $file = fopen($this->fileName, "a");
            fwrite($file, $this . PHP_EOL);
            fclose($file);
            $return = true;
        }
        return $return;
    }

    public function PrecioMasIva()
    {
        $return = $this->precio * 1.21;
        return $return;
    }



    public static function Vender($sabor, $cantidad, &$precio)
    {
        $return = false;
        $heladoAVender = [];
        $file = fopen("./helados/sabores.txt", "r");
        while (!feof($file)) {
            $helado = fgets($file);
            $arrayStringhelado = explode("-", $helado);
            if (count($arrayStringhelado) == 3)
                if ($arrayStringhelado[0] == $sabor) {
                $heladoAVender = new Helado($arrayStringhelado[0], $arrayStringhelado[1]);
                $return = true;
                break;
            }

        }
        fclose($file);
        if ($return) {
            $precio = $heladoAVender->PrecioMasIva() * $cantidad;
            $string = $heladoAVender->sabor . "-$" . $precio . "-" . $cantidad . PHP_EOL;
            self::writeLine("helados/vendidos.txt", $string);
        }

        return $return;
    }

    public static function writeLine($fileName, $stringToAppen)
    {
        $return = false;
        if (strlen($stringToAppen) > 0) {
            $file = fopen($fileName, "a");
            fwrite($file, PHP_EOL . $stringToAppen);
            fclose($file);
            $return = true;
        }
        return $return;
    }

    public static function LeerArchivo(&$listaHelados)
    {
        $retorno = false;
        $listaHelados = [];
        $file = fopen("./helados/sabores.txt", "r");
        while (!feof($file)) {
            $helado = fgets($file);
            $arrayStringhelado = explode("-", $helado);
            if (count($arrayStringhelado) == 3) {
                $helado = new Helado($arrayStringhelado[0], $arrayStringhelado[1]);
                $helado->foto = $arrayStringhelado[2];
                array_push($listaHelados, $helado);
            }
        }

        if (count($listaHelados) > 0)
            $retorno = true;
        return $retorno;

    }

    public static function MostrarTabla()
    {
        $listaHelados;
        $tabla = "<table style='width:100%'> <tr>   
        <th>Sabor</th>          <th>Precio</th>           <th>Foto </th>        </tr>";
        if (self::LeerArchivo($listaHelados)) {
            foreach ($listaHelados as $key => $helado) {
                $tabla .= "<tr><td>" . $helado->sabor . "</td>";
                $tabla .= "<td>" . $helado->PrecioMasIva() . "</td>";
                $tabla .= "<td><img
                src='http://localhost:8080/programacion3/Pre-parcial/" . $helado->foto . "'
                 style='height:10%;width:10%'></td></tr>";
                echo "<br><br><br><br>$helado->foto";
            }
            $tabla .= "</table>";
        }

        return $tabla;
    }

    public static function EstaBorrado($sabor)
    {
        $listaHelados = [];
        self::LeerArchivo($listaHelados);
        $return = true;
        foreach ($listaHelados as $key => $helado) {
            if ($sabor == $helado->sabor) {
                $return = false;
                break;
            }
        }

        return $return;
    }

    public static function Borrar($sabor)
    {
        $listaHelados = [];
        self::LeerArchivo($listaHelados);
        $return = true;
        $i = 0;
        $string = "";
        foreach ($listaHelados as $key => $helado) {
            if ($sabor == $helado->sabor) {
                self::Backup($helado->foto);
                unset($listaHelados[$key]);
            } else
                $string .= $helado . PHP_EOL;
        }
        $file = new FileManager("./helados/sabores.txt",$string );

        return $return;
    }

    public static function Backup($file)
    {
        $fileName = explode("/", $file);
        var_dump($fileName);
        echo ($fileName[count($fileName) - 1]);
        echo "<br>.$file";

        $file = trim($file);
        $nameFile = trim($fileName[count($fileName) - 1]);
        copy($file, "./heladosBorrados/" . $nameFile);
        unlink($file);
    }


}
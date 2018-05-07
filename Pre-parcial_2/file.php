<?php
class Manejador_Archivos
{
    public static function read($fileName, &$file)
    {
        $return = false;
        if (file_exists($fileName)) {
            $file = fopen($fileName, "r");
            $return = true;
        }
        return $return;
    }

    public function writeLine($fileName, $stringToAppen)
    {
        $return = false;
        if (file_exists($fileName) && strlen($stringToAppen) > 0) {
            $file = fopen($fileName, "a");
            fwrite($file, $stringToAppen . PHP_EOL);
            fclose($file);
            $return = true;
        }
        return $return;
    }

    public static function WritteFile($fileName, $stringToAppen)
    {
        $return = false;
        if (file_exists($fileName) && strlen($stringToAppen) > 0) {
            $file = fopen($fileName, "w");
            fwrite($file, $stringToAppen);
            fclose($file);
            $return = true;
        }
        return $return;
    }

    ///Cesta clase recibe el nombre del archivo, una variable por referencia apra guardar el patth del archivo
    /// y también el path de la carpeta donde se guardará. 
    //IMPORTANTE: la la foto tiene que tener la key "foto"
    function guardarFoto(&$pathFoto, $nombre, $carpeta)
    {
        if ($_FILES["foto"]["error"] == 0) {
            $type = explode("/", $_FILES["foto"]["type"]); // Saco el tipo
            move_uploaded_file($_FILES["foto"]["tmp_name"], $carpeta . $nombre.".".$type[1]); //Copio de archivos temporales.
            $pathFoto = $carpeta . $nombre.".".$type[1]; //Guardo el nombre
        }
    }

    public static function BackupFoto($file ,$backUpPath,$nameFileFinal)
    {
        $fileName = explode("/", $file);
        $file = trim($file);
        $nameFile = trim($fileName[count($fileName) - 1]);
        $arrayFileName = explode(".",$nameFile);
        copy($file, $backUpPath. $nameFileFinal);
        unlink($file);
    }


}
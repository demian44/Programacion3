<?php
class FileManager
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
            fwrite($file, PHP_EOL . $stringToAppen);
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
    }
 }
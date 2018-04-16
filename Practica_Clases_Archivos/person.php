<?php
class Person
{
    public $name;
    public $surname;
    public $legajo;
    public $dni;
    public $file;
    public function __construct($name, $surname, $legajo, $dni)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->legajo = $legajo;
        $this->dni = $dni;
        $this->file = "-";
    }

    public function __toString()
    {
        return "$this->name-$this->surname-$this->legajo-$this->dni-$this->file";
    }

    public function leerArchivo($fileName)
    {
        $file = fopen($fileName, "r");
        $personList = [];

        while (!feof($file)) {

            $persona = fgets($file);
            $arrayPersona = explode("-", $persona);
            if (count($arrayPersona) == 5) {
                $person = new Person($arrayPersona[0], $arrayPersona[1], $arrayPersona[2], $arrayPersona[3]);
                $person->file =  $arrayPersona[4];
                array_push($personList, $person);
            }
        }
        return $personList;
    }

    public function escribirArchivo($fileName)
    {
        if ($this->file != "-") {
            $file = fopen($fileName, "a");
            $stringPerson = PHP_EOL . $this;
            fwrite($file, $stringPerson);
            fclose($file);
        } else {
            echo "no hay photo";
        }
    }

    public function sobreEscribirArchivo($fileName, $arrayPersonas)
    {
        $file = fopen($fileName, "w");
        foreach ($arrayPersonas as $key => $persona) {
            $stringPerson = PHP_EOL . $persona;
            fwrite($file, $stringPerson);
        }
        fclose($file);
    }

    /*
    ["photo"]=> array(5) { ["name"]=> string(27) "Captura de pantalla (1).png"
    ["type"]=> string(9) "image/png" ["tmp_name"]=> string(24) "C:\xampp\tmp\phpBC75.tmp"
    ["error"]=> int(0) ["size"]=> int(905196) } } Damian.png
     **/
    public function SaveFile()
    {

        if ($_FILES["photo"]["error"] == 0) {
            $type = explode("/", $_FILES["photo"]["type"]);
            $name = $this->name . "." . $type[1];
            echo "$name";
            move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/" . $name);
            $this->file = "./images/" . $name;
        }
    }

    public function addPerson($fileName)
    {
        $this::SaveFile();
        $personList = $this->leerArchivo($fileName);
        $flagNoRepetido = true;
        foreach ($personList as $person) {
            if ($person->legajo == $this->legajo) {
                $flagNoRepetido = false;
                break;
            }
        }
        if ($flagNoRepetido) {
            $this::escribirArchivo($fileName);
        }
        fclose($fileName);
    }
    public function editPerson($fileName)
    {
        $personList = $this->leerArchivo($fileName);
        var_dump($personList);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        $newPersonListEdited = [];
        $isEdit = false;
        foreach ($personList as $person) {
            var_dump($person);
            if ($person->legajo == $this->legajo) {
                if ($this->file == "-") {
                    $this->file = $person->file;
                    echo " asdsd    $person->file";
                    $this->Backup($person->file);
                    $this::SaveFile();
                }
                array_push($newPersonListEdited, $this);
                $isEdit = true;
                break;
            } else {
                array_push($newPersonListEdited, $person);
            }
        }
        if ($isEdit) {
            $this::sobreEscribirArchivo($fileName,$newPersonListEdited);
        }
    }

    function Backup($file){
        $fileName = explode("/",$file);
        copy($file,"./backup/".$fileName[count($fileName)-1]);
        unlink($this->file);
    }
}

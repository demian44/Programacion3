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
    
    public static function ShowPersonArray()
    {
        $personArray = Person::leerArchivo("./Data/data.txt");
        $stringPersonList = "";
        foreach ($personArray as $key => $person) {
            $stringPersonList .="-".$person."<br>--------------<br>";
        }

        return $stringPersonList;
    }

    public static function leerArchivo($fileName)
    {
        $file = fopen($fileName, "r");
        $personList = [];

        while (!feof($file)) {
            $persona = fgets($file);
            $arrayPersona = explode("-", $persona);
            if (count($arrayPersona) == 5) {
                $person = new Person($arrayPersona[0], $arrayPersona[1], $arrayPersona[2], $arrayPersona[3]);
                $person->file = $arrayPersona[4];
                array_push($personList, $person);
            }
        }
        fclose($file);
        return $personList;
    }

    public function escribirArchivo($fileName)
    {
        if ($this->file != "-") {
            $file = fopen($fileName, "a");
            $stringPerson = $this;
            echo "<br>".$stringPerson."<br>";
            fwrite($file, PHP_EOL.$stringPerson);
            fclose($file);
        } else {
            echo "no hay foto";
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
        $personList = $this->leerArchivo($fileName);
        $flagNoRepetido = true;
        foreach ($personList as $person) {
            if ($person->legajo == $this->legajo) {
                $flagNoRepetido = false;
                break;
            }
        }
        if ($flagNoRepetido) {
            $this::SaveFile();
            $db = new Db();
            $db->addUser($this);
            $this::escribirArchivo($fileName);
        }
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
            $db = new Db();
            $db->editPerson($this);
            //$this::sobreEscribirArchivo($fileName, $newPersonListEdited);
        }
    }

    public function DeletePerson($fileName)
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
            if ($person->legajo != $this->legajo) {
                array_push($newPersonListEdited, $person);
            }
            else 
                $this->Backup($person->file);
        }
        if ($isEdit) {
            $this::sobreEscribirArchivo($fileName, $newPersonListEdited);
        }
    }

    public function Backup($file)
    {        
        $fileName = explode("/", $file);
        copy($file, "./backup/" . $fileName[count($fileName) - 1]);
        unlink($file);
    }
}
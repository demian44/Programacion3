<?php
class Person
{

    public $name;
    public $surname;
    public $legajo;
    public $dni;
    public $file;

    /////////////CONSTRUCTOR//
    public function __construct($name, $surname, $legajo, $dni, $id)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->legajo = $legajo;
        $this->dni = $dni;
        $this->file = "-";
        $this->id = $id;
    }

    /////////////MÉTODOS MÁGICOS//
    public function __toString()
    {
        return "$this->name-$this->surname-$this->legajo-$this->dni-$this->id-$this->file";
    }

    /////////////MÉTODOS//
    public static function ShowPersonArray()
    {
        $stringPersonList = "Error al leer el archivo";
        $personList = [];
        if (Person::ReadFile("./Data/data.txt", $personList)) {
            $stringPersonList = "";
            $string = "";
            foreach ($personList as $key => $person) {
                $arrayPersona = explode("-", $person);
                //var_dump($arrayPersona);
                $string = "Nombre: " . $arrayPersona[0] . "- Apellido: " . $arrayPersona[1] . "- DNI: " . $arrayPersona[2] .
                    "ID: " . $arrayPersona[3] . "- Path foto: " . $arrayPersona[0];
                $stringPersonList .= PHP_EOL . PHP_EOL . $string;
            }
        }

        return $stringPersonList;
    }

    public static function ReadFile($fileName, &$personList)
    {
        $personList = [];
        $return = false;
        if (FileManager::read($fileName, $file)) {
            $return = true;
            while (!feof($file)) {
                $persona = fgets($file);
                $arrayPersona = explode("-", $persona);
                if (count($arrayPersona) == 6) {
                    $person = new Person($arrayPersona[0], $arrayPersona[1], $arrayPersona[2], $arrayPersona[3], $arrayPersona[4]);
                    $person->file = $arrayPersona[5];
                    array_push($personList, $person);
                }
            }
            fclose($file);
        }
        return $return;
    }

    public function SaveDataOnFile($fileName, &$messege)
    {
        $return = false;
        if ($this->file != "-") {
            $stringPerson = $this;
            if (FileManager::writeLine($fileName, $stringPerson)) {
                $return = true;
            } else
                $messege = "error al leer el archivo";
        } else
            $messege = "no hay foto";

        return $return;
    }

    public function sobreEscribirArchivo($fileName, $arrayPersonas)
    {
        $stringToWritte = "";
        foreach ($arrayPersonas as $key => $persona) {
            $stringToWritte .= PHP_EOL . $persona;
        }

        if (strlen($stringToWritte) > 0) {
            FileManager::WritteFile($fileName,$stringToWritte);
        }
    }

    public function SaveFile()
    {
        if ($_FILES["photo"]["error"] == 0) {
            $type = explode("/", $_FILES["photo"]["type"]);
            $name = $this->name . "." . $type[1];
            move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/" . $name);
            $this->file = "./images/" . $name;
        }
    }

    public function AddPerson($fileName, &$messege)
    {
        $return = false;
        $flagNoRepetido = false;
        if ($this->ReadFile($fileName, $personList)) {
            $flagNoRepetido = true;
            foreach ($personList as $person) {
                if ($person->legajo == $this->legajo) {
                    $flagNoRepetido = false;
                    break;
                }
            }
        }
        if ($flagNoRepetido) {
            $this::SaveFile();
            $PersonDb = new PersonDb();
            $PersonDb->AddUser($this);//
            if ($this::SaveDataOnFile($fileName, $messege)) {
                $return = true;
            }
        } else
            $messege = "Ya existe el usuario";
        return $return;
    }

    public function EditPerson($fileName)
    {
        $personList;

        if ($this->ReadFile($fileName, $personList)) {
            var_dump($personList);
            $newPersonListEdited = [];
            $isEdit = false;
            foreach ($personList as $person) {
                var_dump($person);
                if ($person->legajo == $this->legajo) {
                    if ($this->file == "-") {
                        $this->file = $person->file;
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
                $PersonDb = new PersonDb();
                $PersonDb->EditPerson($this);
                $this::sobreEscribirArchivo($fileName, $newPersonListEdited);
            }
        }
    }

    public function DeletePerson($fileName)
    {
        $personList = $this->ReadFile($fileName);
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
            } else
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
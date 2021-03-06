<?php

class PersonDb extends Db
{

    public function __construct()
    {
        $this->connectionString =  'mysql:host=localhost;dbname=cdcol;charset=utf8';
    }

    public function getUsers()
    {
        $pdo = $this::connect();

        $query = $pdo->query("select * from person");
        $arrayPerson = [];
        while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            $person = new Person($fila["name"], $fila["surname"], $fila["legajo"], $fila["id"], $fila["file"]);
            $person->dni = $fila["dni"];
            array_push($arrayPerson, $person);
        }

        return $arrayPerson;
    }

    public function traerLista($query){
        $pdo = $this::connect();

        $query = $pdo->query($query);
        $arrayPerson = [];
        while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            $person = new Person($fila["name"], $fila["surname"], $fila["legajo"], $fila["id"], $fila["file"]);
            $person->dni = $fila["dni"];
            array_push($arrayPerson, $person);
        }

        return $arrayPerson;
    }

    public function AddUser($person)
    {
        $exist = false;//Instancia
        if ($person->file != "-") {

            $personList = self::getUsers();
            foreach ($personList as $key => $personOfList) {
                if($personOfList->legajo == $person->legajo)
                {
                    $exist = true;
                    break;
                }
            }
            if(!$exist){ //Si no existe lo agrego.
                $pdo = $this::connect();
                $query = $pdo->query("insert into person (name, surname, legajo, dni, id,file) values ('$person->name','$person->surname',$person->legajo,$person->dni,$person->id,'$person->file')");
            }
        }
    }

    public function EditPerson($person)
    {
        $pdo = self::connect();
        $query = $pdo->query("update person set name = '$person->name', surname = '$person->surname', legajo = $person->legajo, file = '$person->file',dni =  $person->dni, id= $person->id where dni = $person->dni");
        $resul = $query->execute();
        var_dump($resul);
    }

    public function Delete($legajo)
    {
        $pdo = self::connect();
        $query = $pdo->query("delete from person where legajo = $legajo");
        $resul = $query->execute();
        var_dump($resul);
    }
}



?>
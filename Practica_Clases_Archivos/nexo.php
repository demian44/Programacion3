<?php
include "./person.php";
include "./db.php";
include "./personDb.php";
include "./file.php";

$messege = "";
if (isset($_GET["accion"])) {
    $staingInfo = Person::ShowPersonArray();
        // echo "$staingInfo";
    $personDb = new PersonDb();
    //$person = $personDb->getUsers();
    //var_dump($person);
    //Person::ShowPersonArray($staingInfo);
    echo "$staingInfo";
} else if (isset($_POST["accion"])) {
    $persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"], $_POST["id"]);
        //var_dump($persona);
    switch ($_POST["accion"]) {
        case 'cargar':
            if(!$persona->AddPerson("./Data/data.txt", $messege)) // Acá agrego la persona en un archivo
            {
                echo "$messege";                
            }
            else 
                echo "persona guardada correctamente";
            $personDb = new PersonDb();
            $personDb->AddUser($persona); // Acá agrego la persona en la base de detos
            break;
        case 'modificar':
            $persona->EditPerson("./Data/data.txt");
            break;
        case 'eliminar':
                    #code...
            break;
    }
}

?>
    
 

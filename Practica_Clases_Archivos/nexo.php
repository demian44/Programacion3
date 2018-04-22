<?php
include "./person.php";
include "./db.php";
include "./personDb.php";


if (isset($_GET["accion"])) {
        // $staingInfo = Person::ShowPersonArray();
        // echo "$staingInfo";
    $personDb = new PersonDb();
    $person = $personDb->getUsers();
    var_dump($person);
    Person::ShowPersonArray($person);
} else if (isset($_POST["accion"])) {
    $persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"],$_POST["id"]);
        //var_dump($persona);
    switch ($_POST["accion"]) {
        case 'cargar':
            $persona->addPerson("./Data/data.txt"); // Acá agrego la persona en un archivo
            $personDb = new PersonDb();
            $personDb->addUser($persona); // Acá agrego la persona en la base de detos
            break;
        case 'modificar':
            $persona->editPerson("./Data/data.txt");
            break;
        case 'eliminar':
                    #code...
            break;
    }
}

?>
    
 

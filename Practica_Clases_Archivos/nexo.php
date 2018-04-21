<?php
include "./person.php";
include "./db.php";

if (isset($_GET["accion"])) {
        // $staingInfo = Person::ShowPersonArray();
        // echo "$staingInfo";
    $db = new Db();
    $person = $db->getUsers();
    Person::ShowPersonArray($person);

} else if (isset($_POST["accion"])) {
    $persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"],$_POST["id"]);
        //var_dump($persona);
    switch ($_POST["accion"]) {
        case 'cargar':
            $persona->addPerson("./Data/data.txt"); // Acá agrego la persona en un archivo
            $db = new Db();
            $db->addUser($persona); // Acá agrego la persona en la base de detos
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
    
 

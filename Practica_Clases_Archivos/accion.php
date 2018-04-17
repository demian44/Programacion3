<?php
include "./person.php";

//var_dump($_POST);echo"<br>";
$persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"]);
switch ($_POST["cargar"]) {
    case 'cargar':
        $persona->addPerson("./Data/data.txt");
        break;
    case 'modificar':
        $persona->editPerson("./Data/data.txt");
        break;
    case 'eliminar':
        $persona->DeletePerson("./Data/data.txt");
        break;
        default: 
            echo("<br>".$persona->ShowPersonArray());
        break;
}



// Pepito-Luison-12354-99999999-./images/Demian.png  
// DEMIAN-Luison-235-99999999-./images/Demian.png  
// PeASDSD-Luison-154-99999999-./images/Demian.png  

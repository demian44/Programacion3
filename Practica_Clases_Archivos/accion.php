<?php
    include "./person.php";

    //var_dump($_POST);echo"<br>";
    $persona = new Person($_POST["name"],$_POST["surname"],$_POST["legajo"],$_POST["dni"]);
    switch ($_POST["cargar"]) {
        case 'cargar':
                $persona->addPerson("./Data/data.txt");
                break;
            case 'modificar':
                $persona->editPerson("./Data/data.txt");
                break; 
    }

?>
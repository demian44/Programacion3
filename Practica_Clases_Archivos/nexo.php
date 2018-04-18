<?php
    include "./person.php";
    include "./db.php";

    if(isset($_GET["accion"])){
        // $staingInfo = Person::ShowPersonArray();
        // echo "$staingInfo";
    $db = new Db();
    $db->test2();
        
    }        
    else if(isset($_POST["accion"])){
        $persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"]);
        //var_dump($persona);
        switch($_POST["accion"]){
            case 'cargar':
                 $persona->addPerson("./Data/data.txt");
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
    
 

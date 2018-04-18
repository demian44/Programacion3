<?php
    include "../Practica_Clases_Archivos/person.php";

    if(isset($_GET["accion"])){
        Person::leerArchivo("")
        Person::ShowPersonArray()
    }        
    else if(isset($_POST["accion"])){
        $persona = new Person($_POST["name"], $_POST["surname"], $_POST["legajo"], $_POST["dni"]);
        //var_dump($persona);
        switch($_POST["accion"]){
            case 'cargar':
                 $persona->addPerson("../Practica_Clases_Archivos/Data/data.txt");
                    break;
                case 'modificar':
                    $persona->editPerson("../Practica_Clases_Archivos/Data/data.txt");
                    break;
                case 'eliminar':
                    #code...
                    break;
            }
         }
    
?>
    
 

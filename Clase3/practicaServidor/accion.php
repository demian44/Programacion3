<?php
    include "entidades/person.php";
    // var_dump($_GET);
    // echo "<br>";
    // echo($_GET["nombre"]);
    var_dump($_POST);

    echo "<br>";
    //  echo($_POST["nombre"]);
    echo "<br>";echo "<br>";echo "<br>";
    // var_dump($_REQUEST);
    //  var_dump(ISSET($_GET["nombre"]));
    echo("<br>");
    echo("<a href='index.php'> Volver </a>");
    echo("<br>");    echo("<br>");    echo("<br>");    echo("<br>");

    $nombreArchivo = "nombe_archivo.txt";
    
    switch ($_POST["cargar"]) {
        case 'modificar':
            $file = fopen($nombreArchivo,"r");  
            $person = new Person($_POST["name"],$_POST["surname"],$_POST["age"],$_POST["file"]);
            while(!feof($file)){
                $linea = fgets($file);
                
                $userData = explode("-",$linea);
                var_dump($userData);
                $personInList = new Person($userData[0],$userData[1],$userData[2],$userData[3]);
                array_push($personList,$personInList);
            }
            fclose($file);
            $file = fopen($nombreArchivo,"w");  
            foreach ($personList as $key => $value) {
                if($value->file==$person->file){
                    $value->name = $person->name;
                    $value->surname = $person->surname;
                    $value->age = $person->age;
                }
                fwrite($file,$person);
            }
            fclose($file);
            break;
        
        case 'eliminar':
            $person = new Person($_POST["name"],$_POST["surname"],$_POST["age"],$_POST["file"]);
            $person->DeletePerson($nombreArchivo);
        break;
        case 'cargar':
        
        //var_dump($_FILES);
        if($_FILES["archivo"]["error"]==0){   
            $extencion = explode(".",$_FILES["archivo"]["name"]);
            $exten = array_reverse($extencion);
            $direcory = ("./image/".$_POST["name"].".".$exten[0]);
            if(file_exists($direcory)){
                copy($direcory,"./backup/".$_POST["name"].".".$exten[0]);
                echo "existe";
            }

            unlink($direcory);

            move_uploaded_file($_FILES["archivo"]["tmp_name"],"./image/".$_POST["name"].".".$exten[0]);
            $nombreArchivo = $_POST["name"].".txt";
            $file = fopen($nombreArchivo,"a");  
            $person = new Person($_POST["name"],$_POST["surname"],$_POST["age"],$_POST["file"],"./image/".$_POST["name"].".".$exten[0]);
            fwrite($file,PHP_EOL.$person);
            
            fclose($file);
        }
        else 
        echo "no cargo la persona";

            break;
    }







    
?>

















































































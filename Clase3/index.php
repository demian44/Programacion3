<?php
    include "./person.php";
    
    
    $nombreArchivo = "nombe_archivo.txt";
    $file = fopen($nombreArchivo,"r");

    $i=0;
    $personList = [];
    while(!feof($file)){        
        $line = fgets($file);
        $listPerson = explode("-",$line);
        if(sizeof($listPerson>3)){
            $person = new Person($listPerson[0],$listPerson[1],$listPerson[2],$listPerson[3]);
            array_push($personList,$person);
        }
    }

    foreach ($personList as $key => $value) {
        echo($value);
        echo "<br>";
    }
    fclose($file);
    $archvo = fopen("copy.txt","a");
    foreach ($personList as $key => $value) {
        fwrite($archvo,$value);
    }

    

    
    
    /*  
    $nombreArchivo ="nombe_archivo.txt";
    // $archivo = fopen($nombreArchivo,"w"); // Lectura, escritura o ambos, si no existe lo cree.$_COOKIE
    // fwrite($archivo,"Demian-Boullon-45");
    // fwrite($archivo,PHP_EOL."Pepito-Pancho-15");
    // fwrite($archivo,PHP_EOL."Jervacio-Perez-55");
     //fclose($archivo);
    $archivo= fopen($nombreArchivo,"r");
    $i=0;
    $j=0;
    while(!feof($archivo)){
        $i++;
        $linea = fgets($archivo);
        $listaPersonas[$i] = explode("-",$linea);//Recibe el separador y el string a separar
        
    }
    $len;
    foreach ($listaPersonas as $key => $value) {
        if(sizeof($value)>1){
            echo($value[0]);
            echo($value[1]);
            echo($value[2]);
            echo "<br>---------------<br>";    
        }
        
    }
    
    
    ///modo: w,r,a,x
    // fwrite($archivo,"Hola mundo".PHP_EOL);//EL tercer campo es opcional es la cantidad de caracteres a escribir.
    //unlink("SADSA");
    // copy($nombreArchivo,"copia.txt");
    
    // var_dump(fread($archivo,44));
    // echo "<br>";echo "<br>";echo "<br>";
    
    // while(!feof($archivo))
    // {
        //     echo fgets($archivo);
        //     echo "<br>";
        // }
        
        
        
        
        fclose($archivo);
        
        //$contenido = fread($archivo,100);        
        //echo "$contenido";
        
        
        
        ?>
        */
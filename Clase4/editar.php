<?php

    var_dump($_POST);
    echo "<br>";
    var_dump($_FILES);
    $extencion = explode("/",$_FILES["archivo"]["type"]);
    $extencion = explode(".",$_FILES["archivo"]["name"]); 

    
    //EL primer parametro el el path temporal del archivo 
    $file = fopen("persona.txt","a");
    
    

    if($_FILES["archivo"]["size"]<900000){
        $exten = array_reverse($extencion);
        move_uploaded_file($_FILES["archivo"]["tmp_name"],"./image/".$_POST["nombre"].".".$exten[0]);
    }

?>
<?php
    include "./Entidades/IMostrable.php";
    include "./Entidades/direccion.php";
    include "./Entidades/localidad.php";
    include "./Entidades/persona.php";
    include "./Entidades/alumno.php";
    include "./Entidades/profesor.php";
    include "./Entidades/animal.php";

    $i=0;
    $localidad = new localidad(142,"Lomas de Zamora");
    $direccion =  new direccion("Riobamba",201,$localidad );
    $alumno = new alumno("Pepe","Jaime",33225450,$direccion,452,"Coso");
    // echo($persona->DoHtml());
    // $arrayClases[$i] = $persona;
    // $i++;
    // $localidad = new localidad(41,"Avellaneda");
    // $direccion =  new direccion("Belgrano",45,$localidad);
    // $persona = new Persona("Marco Antonio","Solis",3222250,$direccion);
    // $arrayClases[$i] = $persona;
    // $i++;
    // $localidad = new localidad(401,"Lanus");
    // $direccion =  new direccion("Medrano",15,$localidad );
    // $persona = new Persona("Soyla","Mariquita",324658750,$direccion);
    // $arrayClases[$i] = $persona;
    // $tabla = "<table><tr>";
    // foreach($arrayClases as $person){
    //    echo"$person->DOHtml());
    // }
    
    
    $materia[0]    = "Matematica";
    $materia[1]    = "Fisica";
    $dias[0] = "Lunes";
    $dias[1] = "Martes";
    
    $profesor = new Profesor("Pepe","Jaime",33225450,$direccion, $materia, $dias);
    
    echo "<table WIDTH='700' border='3'><tr ><th align='left' padding-left='8px' valign='top' >$alumno</th>&nbsp<th align='left' cellpadding='0' valign='top'>$profesor</th></tr></table>";
?>

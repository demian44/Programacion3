<?php
include "./Entidades/IMostrable.php";
include "./Entidades/direccion.php";
include "./Entidades/localidad.php";
include "./Entidades/persona.php";
include "./Entidades/alumno.php";
include "./Entidades/profesor.php";
include "./Entidades/animal.php";
include "./Entidades/IHtmlBody.php";
include "./Entidades/animalito.php";
include "./Entidades/perro.php";

define("MAX",45);
$i = 0;
$localidad = new localidad(142, "Lomas de Zamora");
$direccion = new direccion("Riobamba", 201, $localidad);
$alumno = new alumno("Pepe", "Jaime", 33225450, $direccion, 452, "Coso");
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

$materia[0] = "Matematica";
$materia[1] = "Fisica";
$dias[0] = "Lunes";
$dias[1] = "Martes";

$profesor = new Profesor("Pepe", "Jaime", 33225450, $direccion, $materia, $dias);
$array["wea"] = "pepe";
$array["harry"] = "pepe2";
$array["Nisman"] = "pepe3";
$array[0] = "pepe3";
$array[1] = "pepe3";

// foreach ($array as $key => $value) {
//     echo "<label><h3>Este es el indice : $key </h3></label><br><label><h3>este es el valor:   $value </h3><label><br>";
// }

// echo "<table WIDTH='700' border='3'><tr ><th align='left' padding-left='8px' valign='top' >
// $alumno</th>&nbsp<th align='left' cellpadding='0' valign='top'>$profesor</th></tr></table>";

$miAnimal = new Animal("firulais", "perro", "5 años", "dálmata");

//var_dump($miAnimal);
$miAnimal->nombre = "Jose Luis";

$animalito = new Perro("Bobby","10/03/2017",45,"Pastor Aleman");
$miAnimal->SetNombre("juan Carlos");

//echo ("<br>Nombre: " . $miAnimal->Getnombre());

echo($animalito->MakeHeader());

$pagina = "</head><body><label><h1>Elementos del array:</h1><br></label>";
foreach ($array as $key => $value) {
    $pagina = $pagina."<br><label>Elemento ".$key.": ".$value."</label>";
}

$pagina .= "</body>";

print $pagina."<br>después del punto"."<br>despues de la coma";

class Auto
{
    private $marca;
    function __construct($wea){
        $this->marca = $wea;
    }

    public function GetMarca(){
        return $this->marca;
    }
    public function SetMarca($value){
        $this->marca = $value;
    }
}

print "<br>";
$auto = new Auto("Fiat");
echo($auto->GetMarca());
print "<br>";
print "<br>";
echo($animalito->GetNombre());
echo "<br>Maximo: ".MAX;
$wea = "<br>wea";
$wea .= " Nisman";
echo $wea;

?>
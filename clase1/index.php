<?php
echo "<html><head><title>Practica</title></head>";
echo "<body><label><h2>Practica<h1><label><br>";
$Array["Harry"] = "Nisman";
var_dump($Array);
$list;
for ($i = 0; $i < 45; $i++) {
    if ($i % 2 == 0) {
        $Array[$i] = $i;
        $list[$i] = "Elemento " . (string) $i . " de la lista";
    } else {
        $Array[$i] = "coso loco" . (string) $i;
    }

    // echo "<br>$Array[$i]";

}
echo "<br><form><input type='button' name='boton' value='Boton 1' style='width:115px; height:50px'><form>";
echo "<form><input type='button' name='button' value='Boton 2' style='width:115px; height:50px'><form><br>";
foreach ($list as &$element) {
    echo "<label><h5>$element</h5></label>";
}

echo "</form></body></html>"

?>

<?php
include "./file.php";
include "./cliente.php";
include "./IVendible.php";
include "./helado.php";

$messege = "";
if (isset($_GET["accion"])) {
    switch ($_GET["accion"]) {
        case 'verTabla':
            $tabla = Helado::MostrarTabla();
            echo "$tabla";
            break;

        case 'borrarHelado':
            if (Helado::EstaBorrado($_GET["sabor"]))
                echo "helado está borrado";
            else
                echo "helado no está borrado";
            break;
    }


} else if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case 'cargar':
            $cliente = new Cliente($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
            $cliente->GuardarEnArchivo();
            break;
        case 'validar':
            $cliente = new Cliente($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
            if ($cliente->Validar())
                echo "Cliente Logueado";
            else
                echo "Cliente inexistente";
            break;
        case 'cargarHelado':
            $helado = new Helado($_POST["sabor"], $_POST["precio"]);
            $helado->GuardarHelado();
            break;
        case 'vender':
            if (Helado::vender($_POST["sabor"], $_POST["cantidad"], $precio)) {
                echo "costo con iva: $" . $precio;
            } else

                echo "no existe el sabor";

            break;
        case "borrarHelado":
            Helado::Borrar($_POST["sabor"]);
            break;

    }
}

?>
    
 
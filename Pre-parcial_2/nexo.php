<?php
require "./file.php";
include "./entidades/vendedor.php";
include "./entidades/IVendible.php";
include "./entidades/helado.php";

$messege = "";

if (isset($_GET["accion"])) {
    switch ($_GET["accion"]) {
        case 'vender':
            if (isset($_GET["sabor"]) && isset($_GET["cantidad"])) { //Chequear campos
                $precio;
                if (Helado_::Vender($_GET["sabor"], $_GET["cantidad"], $precio))
                    echo "$$precio";
                else
                    echo "No existe el sabor";
            } else
                echo "Sabor no seteado";
            break;

        case 'HacerTabla':
            Helado_::HacerTabla();
            break;

        case "borrarHelados":
            if (Helado_::ExisteElado($_GET["sabor"]))
                echo "Existe el sabor.";
            else
                echo "No existe el sabor.";
            break;

        default:
            echo "Acción no encontrada";
            break;
    }


} else if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case 'cargar':
            if (isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["fecha"]) && isset($_FILES["foto"])) {
                $vendedor = new Vendedor($_POST["nombre"], $_POST["fecha"], $_POST["clave"]);
                if ($vendedor->GuardarEnArchivo())
                    echo "Vendedor guardado exitosamente";
                else
                    echo "Error al guardar al usuario";
            } else
                echo "Faltan completar campos.";

            break;
        case 'modificarVendedor':
            if (isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["fecha"])) {
                $vendedor = new Vendedor($_POST["nombre"], $_POST["fecha"], $_POST["clave"]);
                if ($vendedor->Modificar())
                    echo "Vendedor guardado exitosamente";
                else
                    echo "Error al guardar al usuario";
            } else
                echo "Faltan completar campos.";

            break;
        case 'validar':
            $nombre = "";
            if (isset($_POST["clave"]) && Vendedor::Validar($_POST["clave"], $nombre))
                echo "Usuario $nombre logueado";
            else
                echo "Usuario inexistente";
            break;
        case 'cargarHelado':
            $helado = new Helado_($_POST["sabor"], $_POST["precio"]);
            $helado->guardarFoto();
            $helado->Guardar();
            break;
        case "borrarHelados":
            if (isset($_POST["sabor"])) {
                if (Helado_::EliminarHelado($_POST["sabor"]))
                    echo "Helado Eliminado";
                else
                    echo "No existe el sabor.";
            } else
                echo "Gusto no setteado";
            break;
        case "modificar":
            if (isset($_POST["sabor"]) && isset($_POST["precio"])) {
                $helado = new Helado_($_POST["sabor"], $_POST["precio"]);
                $helado->ModificarHelado();
            }
            break;
        case "host":
            $host = gethostname();
            var_dump($_SERVER['HTTP_HOST']);
            echo "<br>";
            var_dump($_SERVER['PHP_SELF']);
            break;
    }
} else
    echo "Sólo se admite método Get y Post";

?>
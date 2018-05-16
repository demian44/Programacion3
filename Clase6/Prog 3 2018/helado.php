<?php
class Helado
{
    public $sabor;
    public $precio;
    public $tipo;

    public function MostrarDatos()
    {
        return $this->sabor . " - " . $this->precio . " - " . $this->sexo;
    }

    public static function TraerClienteNacionalidadSexoArray($precio, $sexo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT sabor, precio, "
            . "sexo FROM clientes WHERE precio = :precio "
            . "AND sexo= :sexo");

        $consulta->execute(array(":precio" => $precio, ":sexo" => $sexo));
        $array = [];
        foreach($consulta->fetchAll() as  $row) {
            array_push($array,$row);
        }

        return $array;
    }

    public function InsertarElClienteParametros()
    {
        echo "Ejecutó";

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (sabor, precio, sexo)"
            . "VALUES(:sabor, :cantante, :sexo)");

        $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':cantante', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
        $consulta->execute();

    }

    public static function ModificarCliente($id, $sabor, $sexo, $cantante)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :sabor, interpret = :cantante, 
                                                        jahr = :sexo WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_INT);
        $consulta->bindValue(':sexo', $sexo, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarCliente($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();

    }

}
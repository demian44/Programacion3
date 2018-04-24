<?php
abstract class Db
{
    protected $connectionString;
    protected function connect()
    {
        $user = "root";
        $pass = "";
        $pdo = new PDO($this->connectionString, $user, $pass);
        return $pdo;
    }


        #este constructor le dará la información para conectarse a la base de datos.
    public abstract function __construct();

}
?>
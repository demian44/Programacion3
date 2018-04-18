<?php
    class Db 
    {
        public static function getUsers(){
            $pdo =  $this::connect();

            $query = $pdo->query("select * from cds");
            $arrayPerson = [];
            while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
                $person = new Person($fila["name"],$fila["surname"],$fila["legajo"],$fila["file"]);
                $person->dni = $fila["dni"];
                array_push($arrayPerson,$person);
            }

            return $arrayPerson;
        }
        
        private static function connect(){
            $connectionStrnig =  'mysql:host=localhost;dbname=cdcol;charset=utf8';
            $user = "root";
            $pass = "";
            $pdo= new PDO($connectionStrnig,$user,$pass);
            return $pdo;
        }
    


        public static function addUser($person){
            $pdo =  $this::connect();

            $query = $pdo->query("insert into person (name, surname, legajo, dni, file) values ('$person->name','$person->surname',$person->legajo,$person->dni,'$person->file')");

        }
        
        public static function editPerson($person){
            $pdo = self::connect();
            $query = $pdo->query("update person set name = '$person->name', surname = '$person->surname', legajo = $person->legajo, file = '$person->file',dni =  $person->dni where dni = $person->dni");
            $resul = $query->execute();
            var_dump($resul);
        }
              
    }
    
    

?>
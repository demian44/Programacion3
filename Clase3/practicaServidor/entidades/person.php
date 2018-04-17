<?php
    class Person 
    {
        public $name;
        public $surname;
        public $age;
        public $file;
        public $photo;
		function __construct($name, $surname,$age,$file,$photo)
    	{
            $this->name = $name;
            $this->surname = $surname;
            $this->age = $age;            
            $this->file = $file;
            $this->photo = $photo;
        }
        
        function __toString()
        {
            return "$this->name-$this->surname-$this->age-$this->file-$this->photo";
        }

        function ShowPersonArray($personArray){
            
        }

        public function GetFile()
        {
            return $this->file;
        }

        public function SetFile($file)
        {
            return $this->file = $file;
        }

        public function SetName($name)
        {
            return $this->name = $name;
        }

        public function SetSurname($surname)
        {
            return $this->surname = $surname;
        }
        public function SetAge($age)
        {
            return $this->age = $age;
        }

        public function DeletePerson($nombreArchivo){
            $personList = array();
            $file = fopen($nombreArchivo,"r");  
            while(!feof($file)){
                $linea = fgets($file);
                
                $userData = explode("-",$linea);
                var_dump($userData);
                if($userData[3]!="1"){
                    $personInList = new Person($userData[0],$userData[1],$userData[2],$userData[3]);
                    array_push($personList,$personInList);
                }
            }
            fclose($file);
            $file = fopen($nombreArchivo,"w");  
            foreach ($personList as $key => $value) {
                if($value->file!=$this->file){
                    echo "<br>";
                    echo(".".$value->file.".");
                    echo(" -  ");
                    echo(".".$this->file.".");
                    fwrite($file,$value);
                }
            }
            fclose($file);


        }
    }
    
?>
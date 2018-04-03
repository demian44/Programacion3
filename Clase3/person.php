<?php
    class Person 
    {
        private $name;
        private $surname;
        private $age;
        private $file;
		function __construct($name, $surname,$age,$file)
    	{
            $this->name = $name;
            $this->surname = $surname;
            $this->age = $age;            
            $this->file = $file;
        }
        
        function __toString()
        {
            return "$this->name-$this->surname-$this->age-$this->file";
        }
    }
    
?>
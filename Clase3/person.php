<?php
    class Person 
    {
        public $name;
        public $surname;
        public $age;
        public $file;
        
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
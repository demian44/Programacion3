<?php
	class Animal implements IMostrable{
		public $nombre; 
		public $tipoAnimal;
		public $edad;
		public $raza;
		

		function __construct($nombre, $tipoAnimal, $edad, $raza)
		{
			$this->nombre = $nombre;
			$this->tipoAnimal = $nombre;
			$this->edad = $edad;
			$this->raza = $raza	;
		}
	}


?>
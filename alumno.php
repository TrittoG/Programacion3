<?php

class Alumno
{
	public $nombre;
	public $edad;

	
	public function __construct($a = NULL, $b=NULL)
	{
		$this-> nombre = $a;
		$this -> edad = $b;
	}

	public function retornarJson()
	{
		return json_encode($this);
	}

}




?>
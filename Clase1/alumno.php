<?php

include "Persona.php";
class Alumno extends Persona
{
	
	public $legajo;

	
	public function __construct($nombre = NULL, $edad=NULL, $dni= NULL, $legajo = NULL)
	{
		parent::__construct($dni, $nombre, $edad);
		$this ->legajo = $legajo;

	}

	public function retornarJson()
	{
		return json_encode($this);
	}

}




?>
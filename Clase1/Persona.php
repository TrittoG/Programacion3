<?php
require "Humano.php";

Class Persona extends Humano
{
	public $dni;

	public function __construct($dni = NULL, $nombre = NULL, $edad = NULL)
	{
		parent::__construct($nombre, $edad);
		$this-> dni = $dni;
		
	}

	public function retornarJson()
	{
		return json_encode($this);
	}
}

?>
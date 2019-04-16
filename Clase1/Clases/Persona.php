<?php
require "Humano.php";

Class Persona extends Humano
{
	public $dni;


	public function retornarJson()
	{
		return json_encode($this);
	}
}

?>
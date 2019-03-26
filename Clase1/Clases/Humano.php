<?php

Class Humano
{
	public $nombre;
	public $edad;

	public function __construct($nombre = NULL, $edad=NULL)
	{
		$this-> nombre = $nombre;
		$this -> edad = $edad;
	}

	public function retornarJson()
	{
		return json_encode($this);
	}
}

?>
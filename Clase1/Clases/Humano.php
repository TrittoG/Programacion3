<?php

Class Humano
{
	public $nombre;
	public $edad;

	
	public function retornarJson()
	{
		return json_encode($this);
	}
}

?>
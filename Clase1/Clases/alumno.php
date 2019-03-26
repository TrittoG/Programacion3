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


	public function guardarAlumno($path)
	{
		$aux = $this->retornarJson();

		if(file_exists($path))
		{
			$gestor = fopen($path, 'a');
			fwrite($gestor, $aux .= "\r\n");
			fclose($gestor);
		}
		else
		{
			$gestor = fopen($path, 'w');
			fwrite($gestor,$aux .= "\r\n");
			fclose($gestor);
		}
	
	}

	public function leerAlumno($path)
	{
		$contenido = '';

		if(file_exists($path))
		{
			
		/*	while (!feof($gestor)) 
			{
    			$contenido .= fgets($gestor);
			}
			fclose($gestor);*/
			$arrayAlumnos = array();
			$i = 0;
			$gestor = fopen($path, 'r');
			while (($búfer = fgets($gestor, 4096)) !== false) 
			{
		        $arrayAlumnos[$i] = $búfer .= "\r\n";
		        $i++;
		    }
		    
		    fclose($gestor);
				

			return $arrayAlumnos;
		}

	}

	




}




?>
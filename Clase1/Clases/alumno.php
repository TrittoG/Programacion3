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

	// function guardarJson($path)
	// {
 //        if(file_exists($path)){
 //            $gestor = fopen($path, "a");                
 //            fwrite($gestor,$this->retornarJson());
 //            fclose($gestor);
 //        }
 //        else{
 //            $gestor = fopen($path, "w");                
 //            fwrite($gestor,$this->retornarJson());   
 //            fclose($gestor);
 //        }
 //    }




	// public function leerAlumno($path)
	// {
	// 	$contenido = '';

	// 	if(file_exists($path))
	// 	{
	// 		//abro el archivo para lectura
	// 		$gestor = @fopen($path, 'r');

	// 		$arrayAlumnos = array();
	// 		$i = 0;

	// 		while(($buffer = (fgets($gestor, 4096)) !== false))
	// 		{
	// 			$arrayAlumnos[$i] = json_decode($buffer, true);
	// 			$i++;
	// 		}

	// 		fclose($gestor);
	// 	}

	// 	return $arrayAlumnos;
	// }



    // public static function LeerAlumnoJSON($path)
    // {
    //     if(file_exists($path))
    //     {
    //         $myfile = fopen($path, "r");
    //         $datos = fread($myfile,filesize($path));
    //         fclose($myfile);               
    //     }
    //     return json_decode($datos);
    // }



	public static function Leer($path)
	{
		$ListaDeAlumnosLeida=   array();
		$archivo=fopen($path, "r");//lee y mantiene la informacion existente
			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			
			$Alumno=explode("=>", $renglon);
			
			$Alumno[0]=trim($Alumno[0]);
			if($Alumno[0]!="")
				$ListaDeAlumnosLeida[]=$Alumno;
		}
		fclose($archivo);
		return $ListaDeAlumnosLeida;
		
	}

}




?>
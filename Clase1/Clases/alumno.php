<?php

include "Persona.php";
include "AccesoDatos.php";

class Alumno extends Persona
{
	public $nombre;
	public $edad;
	public $dni;
	public $legajo;
	

	


	public function similConstructor($nombre, $edad, $dni, $legajo)
	{
		$this->nombre = $nombre;
		$this->edad = $edad;
		$this->dni = $dni;
		$this->legajo = $legajo;
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



	//funcion para consultas SQL------------------------------------------------------------------------------
	public static function TraerAlumnos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select `nombre`, `edad`, `dni`, `legajo`, `id` from alumnos");
			$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");	
	}

	public function InsertarAlumno()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumnos (nombre,edad,dni, legajo)values('$this->nombre','$this->edad','$this->dni','$this->legajo')");
			$consulta->execute();
			return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function ModificarAlumno()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
				update alumnos 
				set nombre='$this->nombre',
				edad='$this->edad',
				dni='$this->dni',
				legajo='$this->legajo'
				WHERE id='$this->id'");
				//como obtengo el id
		return $consulta->execute();
	}


	public static function BorrarAlumnoPorLegajo($legajo)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from alumnos 				
				WHERE legajo=:legajo");	
		$consulta->bindValue(':legajo',$legajo, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

	public function BorrarAlumno()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from alumnos 				
				WHERE legajo=:legajo");	
				$consulta->bindValue(':legajo',$this->legajo, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }


	

	 //-------------DELETE----------------

	 public function SetParams($parameters)
	 {
	   if($parameters != null)
	   {
		 $nombre = array_key_exists("nombre", $parameters) ? $parameters["nombre"] : "noname";
		 $edad = array_key_exists("edad", $parameters) ? $parameters["edad"] : 0;
		 $dni = array_key_exists("dni", $parameters) ? $parameters["dni"] : 0;
		 $legajo = array_key_exists("legajo", $parameters) ? $parameters["legajo"] : 0;
   
		 $this->nombre = $nombre;
		 $this->edad = $edad;
		 $this->dni = $dni;
		 $this->legajo = $legajo;

	   }

	}



	public static function StdToAlumno($object)
  {
    $nombre = null;
    $edad = null;
    $dni = null;
    $legajo = null;

    if(is_array($object))
    {
      if(array_key_exists("nombre", $object))
        $nombre = $object["nombre"];
      if(array_key_exists("edad", $object))
        $edad = $object["edad"];
      if(array_key_exists("dni", $object))
        $dni = $object["dni"];
      if(array_key_exists("legajo", $object))
        $legajo = $object["legajo"];

      $parameters = array(
        "nombre" => $nombre,
        "edad" => $edad,
        "dni" => $dni,
        "legajo" => $legajo,
      );

      $alumno = new Alumno();
      $alumno->SetParams($parameters);
      return $alumno;
    }
  }


}




?>
<?php

class miClase
{
    public $id;
    public $nombre;
    public $email;
    public $foto;

    //simil constructor para que no de errores al guardar en SQL
    public function similConstructor($nombre = null, $email = null, $foto = null, $id = null)
    {
        $this -> nombre = $nombre;
        $this -> email = $email;
        $this -> foto = $foto;
        $this -> id = $id;
    } 

    //retorna un Json del objeto
    public function retornarJSon()
    {
        return json_encode($this);
    }


    //------------------------------ARCHIVOS----------------------------------------------


    //guarda el archivo en un nuevo renglon dentro de un txt
    public function guardarArchivo($path)
    {
        if($path != null)
        {
            $archivo = $path;
            $actual = $this -> retornarJSon();
            
            if(file_exists($archivo))
            {
                $archivo = fopen($path, "a");		 
            }else
            {
                $archivo = fopen($path, "w");	 
            }
            
            $renglon = $actual.="\r\n";
            
            fwrite($archivo, $renglon); 		 
            fclose($archivo);
        }
	}
	
	//lee un archivo de un txt enviado
	public static function leerArchivo($path)
    {
        $archivo = $path;
		if(file_exists($archivo))
		{
			$gestor = @fopen($archivo, "r");
			$arrayProveedores = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
                $miClase = new miClase();
                $miClase = json_decode($bufer, true);
        		$arrayProveedores[$i] = $miClase;
        		$i++;
           	}
           	
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
            }		
            	
    		fclose($gestor);
    		return $arrayProveedores;
		}   	
    }


	public static function guardarArray($array, $path)
    {
        $archivo=fopen($path, "w"); 	
		foreach ($array as $value) 
		{
            $dato= json_encode($value);
	 		$dato.="\r\n";
			fwrite($archivo, $dato);
		}
        fclose($archivo);
        
      /*  foreach($array as $value)
        {
            $miClase = new miClase();
            $miClase = $value;
            $miClase -> guardarArchivo($path);
        }*/
    }









    //-------------------------------------------PDO---------------------------------


    public function BorrarPDO()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from XXXXXXXX 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	 	public static function BorrarPDOPorDATO($DATO)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from XXXXXX 				
				WHERE dato=:DATO");	
				$consulta->bindValue(':DATO',$DATO, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	public function ModificarPDO()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update XXXXX 
				set titel='$this->titulo',
				interpret='$this->cantante',
				jahr='$this->año'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	 public function ModificarPDOParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update XXXXX 
				set titel=:titulo,
				interpret=:cantante,
				jahr=:anio
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
			$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
			return $consulta->execute();
	 }

  	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->titulo."  ".$this->cantante."  ".$this->año;
	}
	 public function InsertarElPDO()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into XXXXX (titel,interpret,jahr)values('$this->titulo','$this->cantante','$this->año')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }
	 public function InsertarElPDOParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into XXXXX (titel,interpret,jahr)values(:titulo,:cantante,:anio)");
				$consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
				$consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
				$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 


  	public static function TraerTodoLosPDO()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as titulo, interpret as cantante,jahr as año from XXXX");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "XXXX");		
	}

	public static function TraerUnPDO($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, titel as titulo, interpret as cantante,jahr as año from cds where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('XXXX');
			return $cdBuscado;				

			
	}

	public static function TraerUnPDOParametro($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from xxxxx  WHERE id=? AND jahr=?");
			$consulta->execute(array($id, $anio));
			$PDOBuscado= $consulta->fetchObject('XXXX');
      		return $cdBuscado;				

			
	}

	public static function TraerUnCdAnioParamNombre($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
	
	public static function TraerUnCdAnioParamNombreArray($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->execute(array(':id'=> $id,':anio'=> $anio));
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}





}

?>
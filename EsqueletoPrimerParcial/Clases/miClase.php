<?php

class miClase
{
    public $id;
    public $nombre;
    public $edad;
    public $foto;

    public function miConstructor($id, $nombre, $edad, $foto)
    {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> edad = $edad;
        $this -> foto = $foto;
    }

    public function retornarJSon()
    {
        return json_encode($this);
    }

    ///////////////////////ARCHIVO/////////////////////////////

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
}



    //////////////////////FIN ARCHIVO/////////////////////////


    //////////////////////SQL/////////////////////////////////




    ///////////////////////FIN SQL/////////////////////////////




?>
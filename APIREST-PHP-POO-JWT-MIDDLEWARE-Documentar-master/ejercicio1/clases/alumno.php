<?php

    class alumno
    {
        public $id;
        public $nombre;
        public $contrasena;


        

       public function InsertarParametros()
	    {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,contraseña)values(:nombre,:contrasena)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
				$consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	    }
       
        public function TraerUno($request, $response, $args) 
         {
            $id=$args['id'];
              $elCd=alumno::TraerUnCd($id);
             $newResponse = $response->withJson($elCd, 200);  
             return $newResponse;
        }



        public function TraerTodos($request, $response, $args) 
        {
            $todosLosCds=alumno::TraerTodoLosCds();
            $newResponse = $response->withJson($todosLosCds, 200);  
        return $newResponse;
        }







        public function BorrarUno($request, $response, $args) {
            $ArrayDeParametros = $request->getParsedBody();
            $id=$ArrayDeParametros['id'];
            $cd= new alumno();
            $cd->id=$id;
            $cantidadDeBorrados=$cd->BorrarCd();

            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;
            if($cantidadDeBorrados>0)
            {
                    $objDelaRespuesta->resultado="algo borro!!!";
            }
            else
            {
                $objDelaRespuesta->resultado="no Borro nada!!!";
            }
            $newResponse = $response->withJson($objDelaRespuesta, 200);  
            return $newResponse;
        }



        public function ModificarUno($request, $response, $args) {
                //$response->getBody()->write("<h1>Modificar  uno</h1>");
                $ArrayDeParametros = $request->getParsedBody();
                //var_dump($ArrayDeParametros);    	
                $micd = new alumno();
                $micd->id=$ArrayDeParametros['id'];
                $micd->nombre=$ArrayDeParametros['nombre'];
                $micd->contrasena=$ArrayDeParametros['contrasena'];

                $resultado =$micd->ModificarCdParametros();
                $objDelaRespuesta= new stdclass();
                //var_dump($resultado);
                $objDelaRespuesta->resultado=$resultado;
                return $response->withJson($objDelaRespuesta, 200);		
        }







        /* final especiales para slimFramework*/
        public function BorrarCd()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from usuarios 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();
        }

        public static function BorrarCdPorAnio($año)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from usuarios 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$año, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();

        }

        public function ModificarCd()
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update usuarios 
                set nombre='$this->nombre',
                contraseña='$this->contrasena',
                WHERE id='$this->id'");
            return $consulta->execute();

        }
   
 
        public function InsertarElCd()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,contraseña)values('$this->nombre','$this->contrasena')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                

        }

        public function ModificarCdParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update usuarios 
                set nombre=:nombre,
                contraseña=:contrasena
                WHERE id=:id");
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
            $consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
            return $consulta->execute();
        }

        public function InsertarElCdParametros()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,contraseña)values(:nombre,:contrasena)");
                $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
                $consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
                $consulta->execute();		
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function GuardarCD()
        {

            if($this->id>0)
                {
                    $this->ModificarCdParametros();
                }else {
                    $this->InsertarElCdParametros();
                }

        }


        public static function TraerTodoLosCds()
        {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre, contraseña from usuarios");
           $consulta->execute();			
           return $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");		
        }

        public static function TraerUnCd($id) 
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, contraseña from usuarios where id = $id");
                $consulta->execute();
                $cdBuscado= $consulta->fetchObject('alumno');
                return $cdBuscado;				

                
        }

        public static function TraerUnCdAnio($id,$anio) 
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=? AND jahr=?");
                $consulta->execute(array($id, $anio));
                $cdBuscado= $consulta->fetchObject('cd');
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

        public function mostrarDatos()
        {
                return "Metodo mostar:".$this->titulo."  ".$this->cantante."  ".$this->año;
        }




        public static function login($nombre, $password)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select  nombre as nombre, contraseña as contrasena from usuarios  WHERE nombre = ? and contraseña = ?");
            $consulta->execute(array($nombre, $password));
            $UsuarioBuscado= $consulta->fetchObject('alumno');
            return $UsuarioBuscado;		
        }
    }

?>
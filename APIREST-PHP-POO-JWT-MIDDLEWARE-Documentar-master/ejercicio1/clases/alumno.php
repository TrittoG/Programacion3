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
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,contraseña,perfil)values(:nombre,:contrasena,:perfil)");
                $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
                $consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
                $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
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




        public static function loginCompare($nombre, $password)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select  nombre as nombre, contraseña as contrasena from usuarios  WHERE nombre = ? and contraseña = ?");
            $consulta->execute(array($nombre, $password));
            $UsuarioBuscado= $consulta->fetchObject('alumno');
            return $UsuarioBuscado;		
        }
    }

?>
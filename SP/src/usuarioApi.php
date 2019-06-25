<?php
require_once "../src/app/models/usuario.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\usuario;

class usuarioApi implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {

    }
    public function TraerTodos($request, $response, $args)
    {
      /*   $objDelaRespuesta= new stdclass();
        $todos = usuario::all();
        $objDelaRespuesta->respuesta=$todos;
        return $response->withJson($objDelaRespuesta, 200); */
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $password= $ArrayDeParametros['password'];
        $tipo= $ArrayDeParametros['tipo'];
        $legajo= $ArrayDeParametros['legajo'];

        
        if($tipo == 'alumno' || $tipo == 'profesor' || $tipo == 'admin')
        {
            $miUser = new usuario();
            $miUser->nombre=$nombre;
            $miUser->password=$password;
            $miUser->tipo=$tipo;
            $miUser->legajo=$legajo;
            $miUser->save();
        
            $objDelaRespuesta->respuesta="Se cargo correctamente";   
        }
        else
        {
            $objDelaRespuesta->respuesta="error de tipo";   
        }


        return $response->withJson($objDelaRespuesta, 200);
        
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);   
        $objDelaRespuesta= new stdclass();

        $legajo=$args['legajo'];
        
        $perfil = $response->getHeader('tipo');

        $elUsuario = new \App\Models\usuario();

        

        $elUsuario = $elUsuario->where('legajo', "=", $legajo)->first();

        var_dump($perfil);
        try
        {

            
            if(!$elUsuario)
            {
                $objDelaRespuesta= new stdclass();
                $objDelaRespuesta->error="no esta el usuario";
                return $response->withJson($objDelaRespuesta, 500); 

            }
            else
            {
                //$miUsuario = new usuario();
                if($elUsuario->tipo == 'alumno')
                {
                    $elUsuario->email=$ArrayDeParametros['email'];
                    $elUsuario->foto=$ArrayDeParametros['foto'];
                    $elUsuario->save();
                }
                else if($elUsuario->tipo == 'profesor' )
                {
                    
                    $elUsuario->email=$ArrayDeParametros['email'];
                    $elUsuario->materias_dictadas=$ArrayDeParametros['materias_dictadas'];
                    $elUsuario->save();

                }
                else 
                {
                    $elUsuario->email=$ArrayDeParametros['email'];
                    $elUsuario->materias_dictadas=$ArrayDeParametros['materias_dictadas'];
                    $elUsuario->foto=$ArrayDeParametros['foto'];
                    $elUsuario->save();
                }
            }     
        
        }
        catch(Exception $e)
        {
            $objDelaRespuesta->respuesta = "error no tienes acceso";
        }
	   
		//var_dump($resultado);
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);		
    }






    public function Login($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $legajo= $ArrayDeParametros['legajo'];
        

        $usuarioLogin = new usuario();
        $usuarioLogin = $usuarioLogin->where('nombre', $nombre)->first();


       

        if($usuarioLogin)
        {
            if($usuarioLogin->nombre == $nombre && $usuarioLogin->legajo == $legajo)
            {
                $datos = array(
                    'nombre'=>$nombre,
                    'tipo'=>$usuarioLogin->tipo,
                    'password'=>$usuarioLogin->password,
                    'legajo'=>$legajo
                );
                return AutentificadorJWT::CrearToken($datos);
            }
            else
            {
                return $response->withJson("nombre o legajo incorrectas", 200);
            }
        }
        else
        {
            return $response->withJson("Nombre invalido", 200);
        }   
    }
}

?>
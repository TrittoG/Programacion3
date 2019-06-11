<?php
require_once '../src/app/models/usuario.php';
require_once '../src/IApiUsable.php';
require_once '../src/AutentificadorJWT.php';

use App\Models\usuario;

class usuarioApi implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        $cds = usuario::all();
        echo $cds->toJson();
        return $response;
    }

    public function CargarUno($request, $response, $args)
    {
        $datos = $request->getParsedBody();

        $nombre = $datos['nombre'];
        $clave = $datos['clave'];
        $sexo = $datos['sexo'];

        $usuario = new \App\Models\usuario();
        $usuario->nombre=$nombre;
        $usuario->clave=$clave;
        $usuario->sexo=$sexo;
        $usuario->perfil = "usuario";
    
        $usuario->save();

        $response->withJson("Carga Exitosa", 200);
        return $response;
    }

    public function Login($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
		$nombre= $ArrayDeParametros['nombre'];
		$contrasena= $ArrayDeParametros['clave'];
		$sexo= $ArrayDeParametros['sexo'];

        $usuarioLogin = new usuario();
        
        $usuarioLogin = $usuarioLogin->where('nombre',$nombre)->first();

		if($usuarioLogin)
		{
            $datos = array( 'nombre' => $nombre,
			'sexo' => $sexo
          );

          var_dump($usuarioLogin->clave);
          if($usuarioLogin->clave == $contrasena && $usuarioLogin->sexo == $sexo)
          {
            return AutentificadorJWT::CrearToken($datos);
          }	
			
		}
		else
		{
			return $response->withJson("no entro", 200);
		}


    
		
	
    }   
}
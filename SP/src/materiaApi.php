<?php
require_once "../src/app/models/materia.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\materia;

class materiaApi implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {

    }
    public function TraerTodos($request, $response, $args)
    {
        $perfil = $response->getHeader('perfil')[0];

        if($perfil == 'admin')
        {
            $objDelaRespuesta= new stdclass();
            $todos = materia::all();
            $objDelaRespuesta->respuesta=$todos;
            return $response->withJson($objDelaRespuesta, 200);
        }
        else
        {
            $idUsuario = $response->getHeader('id')[1];

            $objDelaRespuesta= new stdclass();
            $algunos = materia::where('id', "=",$idUsuario)->get();
            $objDelaRespuesta->respuesta=$algunos;
            return $response->withJson($objDelaRespuesta, 200);

        }
       
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $cuatrimestre= $ArrayDeParametros['cuatrimestre'];
        $cupos= $ArrayDeParametros['cupos'];
        

        $tipo = $response->getHeader('tipo')[0];
        
        if($tipo == 'admin')
        {
            $mimateria = new materia();
            $mimateria->nombre=$nombre;
            $mimateria->cuatrimestre=$cuatrimestre;
            $mimateria->cupos=$cupos;
            $mimateria->save();
            
            $objDelaRespuesta->respuesta="Se cargo correctamente";   
            return $response->withJson($objDelaRespuesta, 200);
        }
        else
        {
            $objDelaRespuesta->respuesta="Solo admins";   
            return $response->withJson($objDelaRespuesta, 200);
        }

        
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {

    }
}

?>
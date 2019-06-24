<?php
require_once "../src/app/models/compra.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\compra;

class compraApi implements IApiUsable
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
            $todos = compra::all();
            $objDelaRespuesta->respuesta=$todos;
            return $response->withJson($objDelaRespuesta, 200);
        }
        else
        {
            $idUsuario = $response->getHeader('id')[1];

            $objDelaRespuesta= new stdclass();
            $algunos = compra::where('id', "=",$idUsuario)->get();
            $objDelaRespuesta->respuesta=$algunos;
            return $response->withJson($objDelaRespuesta, 200);

        }
       
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $articulo= $ArrayDeParametros['articulo'];
        $fecha= $ArrayDeParametros['fecha'];
        $precio= $ArrayDeParametros['precio'];
        

        $idUsuario = $response->getHeader('id')[0];

        $miCompra = new compra();
        $miCompra->articulo=$articulo;
        $miCompra->fecha=$fecha;
        $miCompra->precio=$precio;
        $miCompra->idComprador = $idUsuario;
        $miCompra->save();
        
        $objDelaRespuesta->respuesta="Se cargo correctamente";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {

    }
}

?>
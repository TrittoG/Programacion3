<?php
require_once 'alumno.php';
require_once 'IApiUsable.php';

class alumnoApi extends alumno implements IApiUsable
{
 	
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $titulo= $ArrayDeParametros['titulo'];
        $cantante= $ArrayDeParametros['cantante'];
        $año= $ArrayDeParametros['anio'];
        
        $micd = new cd();
        $micd->titulo=$titulo;
        $micd->cantante=$cantante;
        $micd->año=$año;
        $micd->InsertarElCdParametros();

        $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);
        $extension=array_reverse($extension);

        $archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
        $response->getBody()->write("se guardo el cd");

        return $response;
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



}
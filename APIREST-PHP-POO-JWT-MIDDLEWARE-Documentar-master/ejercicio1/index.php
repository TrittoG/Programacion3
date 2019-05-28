<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../composer/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/alumno.php';
require_once '/clases/alumnoApi.php';
require_once '/clases/MWparaAutentificar.php';
require_once '/clases/AutentificadorJWT.php';
require_once '/clases/MWparaCORS.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);



/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/alumno', function () {   

$this->get('/', \alumnoApi::class . ':traerTodos');
$this->get('/{id}', \alumnoApi::class . ':traerUno');
$this->delete('/', \alumnoApi::class . ':BorrarUno');
$this->put('/', \alumnoApi::class . ':ModificarUno');
$this->post('/', \alumnoApi::class . ':CargarUno');

  
})->add(\MWparaAutentificar::class . ':VerificarUsuario');



$app->group('/login', function () {   

    $this->post('/', \alumnoApi::class . ':Login');

    $this->get("/", function(Request $request, Response $response){

        echo "Bienvenido <br> LOGIN";

        return $response;

    });

      
});



$app->run();

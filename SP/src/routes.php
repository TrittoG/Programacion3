<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
require_once "../src/usuarioApi.php";
require_once "../src/materiaApi.php";
require_once "../src/MWparaAutentificar.php";

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/usuario', function(){
        $this->post('/', \usuarioApi::class . ':CargarUno');
        //$this->get('/', \usuarioApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuarioTraer');
        $this->post('/{legajo}', \usuarioApi::class . ':ModificarUno')->add(\MWparaAutentificar::class . ':VerificarUsuarioTraer');
    });

    $app->post('/login', \usuarioApi::class . ':Login');

    $app->group('/materia', function(){
        $this->post('', \materiaApi::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarLogeadoMateria');
        $this->get('', \materiaApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarTraerMateria');
    }); 
};  



//--------------------------SCRIPTS SQL--------------------------
//CREATE TABLE segundoparcial.usuarios (ProductID int PRIMARY KEY NOT NULL,  ProductName varchar(25) NOT NULL,  Price money NULL,  ProductDescription text NULL)  GO  
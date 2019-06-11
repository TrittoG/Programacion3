<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once "../src/usuarioApi.php";
require_once "../src/MWparaAutentificar.php";

return function (App $app) {
    $container = $app->getContainer();


    $app->group('/usuario', function () {   

        $this->get("/", \usuarioApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuario');
        $this->post("/", \usuarioApi::class . ':CargarUno');
        $this->post("/login", \usuarioApi::class . ':Login');
          
    });

    $app->group('/compra', function () { 

        $this->post('/', )

    });


    

};

<?php
namespace Clases;

// namespace Clases;

// require_once "../src/cdApi.php
// require_once "../src/app/models/cd.php";

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    
    // $container = $app->getContainer();

    //  $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
    //      // Sample log message
    //      $container->get('logger')->info("Slim-Skeleton '/' route");
    //      $cds = cd::all();
    //     echo $cds->toJson();
    //      // Render index view
    //      return $container->get('renderer')->render($response, 'index.phtml', $args);
    //     });

   $app->get('/', \cdApi::class . ':TraerTodos');

};

<?php
namespace Clases;
require_once '../src/app/models/cd.php';
require_once '../src/IApiUsable.php';

class cdApi extends \ORM\cd implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $cds = cd::all();
        echo $cds->toJson();
        return $response;
    }
}
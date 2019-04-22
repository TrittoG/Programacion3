<?php

include_once "./Clases/alumno.php";

//tengo que buscar la forma de recibir los datos del DELETE
//DELETE devuelve un Json con los datos que ingreso el usuario
//necesito saber donde esta ese archivo, retornarlo a json y luego leer de ahi 
//lo que necesito


$datosPUT = fopen("php://input", "r");
$datos = fread($datosPUT, 1024);

$std = new stdClass();

$std = json_decode($datos);
fclose($datosPUT);

$alumno = Alumno::StdToAlumno($std);

var_dump($std);
var_dump($alumno);

$alumno->BorrarAlumno();





?>
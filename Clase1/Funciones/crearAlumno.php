<?php

include_once "/../Clases/alumno.php";

$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$dni = $_POST['dni'];
$legajo = $_POST['legajo'];

$nuevoAlumno = new alumno($nombre, $edad, $dni, $legajo);

$nuevoAlumno -> guardarAlumno("/../Archivos/archivito2.txt");



echo "datos de lo que se guarda <br>";
var_dump($nuevoAlumno -> retornarJson());






?>
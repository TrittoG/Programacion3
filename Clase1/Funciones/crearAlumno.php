<?php

include_once "./Clases/alumno.php";

$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$dni = $_POST['dni'];
$legajo = $_POST['legajo'];

$nuevoAlumno = new alumno();
$nuevoAlumno->similConstructor($nombre,$edad,$dni,$legajo);

//$nuevoAlumno -> guardarAlumno("./Archivos/archivo.txt");

var_dump($nuevoAlumno -> InsertarAlumno());

// echo " <br>----CREAR ALUMNO------ <br>";
// var_dump($nuevoAlumno -> retornarJson());






?>
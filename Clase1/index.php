<?php
include "Alumno.php";


$nombre = "Giuliano";
$edad = 23;

echo "<br>";
var_dump($nombre);
//$array1 = [$nombre => 23];
$array1 = array();
$array1["nombre"] = $nombre;
$array1["edad"] = $edad;

echo "<br>";
var_dump($array1);

$miObjeto = new stdClass();
$miObjeto -> nombre = "Dibu";

echo "<br>";
//creo una instancia de la clase Alumno creada
var_dump($miObjeto);

echo "<br>";



echo "<br> <h1> Hola $nombre</H1>";

//$miAlumno = new Alumno();
//$miAlumno -> nombre = "pepe";
//$miAlumno -> edad = 23;




echo "<br>";


$miAlumno1 = new Alumno("juan", 23);
var_dump($miAlumno1);
echo "<br>";

$miAlumno2 = new Alumno();
var_dump($miAlumno2);
echo "<br>";

echo $miAlumno2 -> retornarJson();

?>
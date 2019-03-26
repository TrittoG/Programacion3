<?php
echo "get   ";
var_dump($_GET);

echo " <br> post    ";

var_dump($_POST);

echo "<br> <br>    ";

include_once "/../Clases/alumno.php";

if(isset($_POST["nombre"]))
{
	$nombre = $_POST["nombre"];		
}
else
{
	$nombre = NULL;
}

if(isset($_POST["edad"]))
{
	$edad = $_POST["edad"];		
}
else
{
	$edad = NULL;
}

if(isset($_POST["dni"]))
{
	$dni = $_POST["dni"];		
}
else
{
	$dni = NULL;
}

if(isset($_POST["legajo"]))
{
	$legajo = $_POST["legajo"];		
}
else
{
	$legajo = NULL;
}

$nuevoAlumno = new alumno($nombre, $edad, $dni, $legajo);

$nuevoAlumno -> guardarAlumno("archivito2.txt");

echo "datos de lo que se guarda <br>";
echo $nuevoAlumno -> retornarJson();






?>
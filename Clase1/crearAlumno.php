<?php
echo "get";
var_dump($_GET);

echo " <br> post";
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];

var_dump($_POST);

echo "<br> $nombre  <br> <br> <br>";

include_once "alumno.php";
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$dni = $_POST["dni"];
$legajo = $_POST["legajo"];

$nuevoAlumno = new alumno($nombre, $edad, $dni, $legajo);

echo $nuevoAlumno -> retornarJson();


?>
<?php

include_once "./Clases/alumno.php";

$nuevoAlumno = new alumno();
echo "<br> <br> LISTAR ALUMNOS--------------";
var_dump($nuevoAlumno->leerAlumno("./Archivos/archivo2.txt"));


?>
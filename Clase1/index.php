<?php



$dato = $_SERVER['REQUEST_METHOD'];

switch ($dato) {

	case 'POST':
		require_once "Funciones/crearAlumno.php";	
		echo $dato;			

		require_once "Funciones/guardarFoto.php";

	break;

	case 'GET' :
		require_once "Funciones/listarAlumnos.php";
		echo $dato;
	break;

	case 'DELETE':
		require_once "Funciones/borrarAlumnos.php";
		echo $dato;
	break;

	case 'PUT':
		require_once "Funciones/modificarAlumnos.php";
		echo $dato;
	break;

	


	
}


?>
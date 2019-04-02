<?php

	include "agregarMarcaAgua.php";

	var_dump($_FILES);
	$datoImagen = $_POST['legajo']."-".$_POST['nombre'];
	$rutaImagen = "./Fotos/".$datoImagen.".jpg";

	//$explode = explode(".", $_FILES['imagen']['name']);
	

	

	if(!file_exists($rutaImagen))
	{
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen);
		agregarMarcaDeAgua($rutaImagen);
		echo "si";
	}
	else
	{
		$hoy = date("m.d.y");
		
		copy($rutaImagen, "./FotosBackup/".$datoImagen."-".$hoy.".jpg");

		move_uploaded_file($_FILES["imagen"]["tmp_name"], "./Fotos/".$datoImagen.".jpg");
	}





?>
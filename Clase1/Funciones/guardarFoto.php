<?php

	include "agregarMarcaAgua.php";

	var_dump($_FILES);
	$datoImagen = $_POST['legajo']."-".$_POST['nombre'];

	$explode = explode(".", $_FILES['imagen']['name']);
	$tamanio = count($explode);


	//le dejo la extencion que tenga la foto,
	$dic = "./Fotos/";
	$dic .= $datoImagen;
	$dic .= ".";
	$dic .= $explode[$tamanio - 1];

	//aca hago lo mismo pero para las que van al backup
	$hoy = date("m.d.y");
	$dicBackup = "./FotosBackup/";
	$dicBackup .= $datoImagen;
	$dicBackup .= "-".$hoy;
	$dicBackup .= ".";
	$dicBackup .= $explode[$tamanio - 1];

	//$dic = agregarMarcaAgua::agregarMarcaDeAgua($dic);

	if(!file_exists($dic))
	{
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);
		
	}
	else
	{	
		copy($dic, $dicBackup);

		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);
	}


	


?>
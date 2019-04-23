<?php 
function guardarFoto($file, $post)
{
	$dic = "./Fotos/";
	$dicBackup = "./FotosBackup/";
	$nameImagen = $file["imagen"]["name"];
	$datoImagen = $post["email"]."-".$post["nombre"];
	$explode = explode(".", $nameImagen);
	$tamaño = count($explode);

	$dic .= $datoImagen;
	$dic .= ".";
	$dic .= $explode[$tamaño - 1];

	$hoy = date("m.d.y");
	$dicBackup .= $datoImagen;
	$dicBackup .= "-".$hoy;
	$dicBackup .= ".";
	$dicBackup .= $explode[$tamaño - 1];

	if(!file_exists($dic))
	{
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);	
	}
	else
	{
		copy($dic, $dicBackup);
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $dic);
	}
    
    return $dic;
}
 ?>
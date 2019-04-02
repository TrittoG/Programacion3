<?php
	
	 function AgregarMarcaDeAgua($imagen)
	{
		$estampa = imagecreatefrompng('/../Fotos/MarcaDeAgua/MarcaDeAgua.png');
		$im = imagecreatefromjpg($imagen);

		$margen_dcho = 100;
		$margen_inf = 100;
		$sx = imagesx($estampa);
		$sy = imagesy($estampa);

		imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));
	
	}
	

?>
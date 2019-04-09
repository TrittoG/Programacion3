<?php
	
	Class AgregarMarcaAgua
	{
		public static function AgregarMarcaDeAgua($imagen)
		{
			$estampa = imagecreatefrompng("./Fotos/MarcaDeAgua/marca-agua.png");
			$im = imagecreatefromjpeg($imagen);
			
			
	
			$margen_dcho = 10;
			$margen_inf = 10;
			$sx = imagesx($estampa);
			$sy = imagesy($estampa);
	
			$im = imagecopymerge($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, $sx, $sy, 50);
			
			return $im;
		}
	}
	
	

?>
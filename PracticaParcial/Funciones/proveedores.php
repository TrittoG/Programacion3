<?php

   
        include_once "./Clases/proveedores.php";
        
        foreach(Proveedores::leerArchivo() as $value)
        {
            $nombre = $value["nombre"];
            $email = $value["email"];
            $foto = $value["foto"];
            $id = $value["id"];

            echo "ID: $id -- Nombre: $nombre -- Email: $email -- Foto: $foto <br>";
        }
    

?>
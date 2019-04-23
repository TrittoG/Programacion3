<?php

    include_once "./Clases/Proveedores.php";
    include_once "./Funciones/agregarFoto.php";

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $foto = $_POST["foto"];
    $id = $_POST["id"];


    $id = isset($_POST["id"])?$_POST["id"]:null;
    $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
    $email = isset($_POST["email"])?$_POST["email"]:null;
    $foto = isset($_POST["foto"])?$_POST["foto"]:null;


    if($id != NULL)
    {
        $arrayProveedores = Proveedores::leerArchivo();

        foreach($arrayProveedores as $value)
        {
            if($value['id'] == $id)
            {
                
                $value['nombre'] = $nombre;
                $value['email'] = $email;
                $value['foto'] = $foto;

            }
        }

        Proveedores::GuardarProveedorArray($arrayProveedores);

        
    }

    


?>
<?php

    include_once "./Clases/pedidos.php";

    foreach(Pedidos::leerArchivo() as $value)
    {
        $producto = $value["producto"];
        $cantidad = $value["cantidad"];
        $idProveedor = $value["idProveedor"];

        foreach(Proveedores::leerArchivo() as $val)
        {
            if($idProveedor == $val["id"])
            {
                $nombre = $val["nombre"];
                echo "Producto: $producto -- Nombre: $nombre -- Cantidad: $cantidad -- Id: $idProveedor <br>";
            }
        }

        
    }

?>
<?php

    include_once "./Clases/proveedores.php";

    $id = $_GET["id"];

    foreach(Pedidos::leerArchivo() as $value)
    {
        $producto = $value["producto"];
        $cantidad = $value["cantidad"];
        $idProveedor = $value["idProveedor"];

        foreach(Proveedores::leerArchivo() as $val)
        {
            if($id == $val["id"])
            {
                echo "Producto: $producto -- Cantidad: $cantidad -- Id: $idProveedor <br>";
            }
        }

        
    }


?>
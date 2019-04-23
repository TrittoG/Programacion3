<?php

    include_once "./Clases/pedidos.php";

    $miObjeto = new Pedidos($_POST["producto"], $_POST["cantidad"], $dic, $_POST["id"]);

    if($miObjeto["idProveedor"] != NULL)
    {
        $miObjeto->guardarArchivo();
    }


?>
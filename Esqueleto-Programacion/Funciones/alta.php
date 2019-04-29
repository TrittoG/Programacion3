<?php
include_once "./Clases/miClase.php";

if(isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["edad"]) && isset($_POST["foto"]))
{
    $miClase = new miClase();
    $miClase -> miConstructor($_POST["id"], $_POST["nombre"], $_POST["edad"], $_POST["foto"]);
    $miClase -> guardarArchivo("./Archivos/datos.txt");
}

?>
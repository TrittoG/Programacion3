<?php
include_once "./Clases/miClase.php";


//--------SI EL ID PARA MODIFICAR SE PASA POR POST--------------------------


if(isset($_POST["id"]))
{
    $id = isset($_POST["id"])?$_POST["id"]:null;
    $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
    $edad = isset($_POST["edad"])?$_POST["edad"]:null;
    $foto = isset($_POST["foto"])?$_POST["foto"]:null;


    $arrayMiClase = miClase::leerArchivo("./Archivos/datos.txt");
    $i = 0;
    foreach($arrayMiClase as $value)
    {
      
        if($value["id"] == $id)
        {
            if($nombre == null)
                $nombre = $value["nombre"];
            if($edad == null)
                $edad = $value["edad"];
            if($foto == null)
            {
                //$foto = guardarFoto($_FILE, null, $value["edad"], $value["nombre"]);
                $foto = $value["foto"];
            } 
           /* else
            {
                $foto = $value["foto"];
            }*/
            
            $newClass = new miClase();
            $newClass -> miConstructor($id, $nombre, $edad, $foto);
            $arrayMiClase[$i] = $newClass;
            
            break;
        }
        $i++;
    }
    miClase::guardarArray($arrayMiClase, "./Archivos/datos.txt");
}


?>
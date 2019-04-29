<?php
    $dato = $_SERVER['REQUEST_METHOD'];

    switch ($dato) {
        case 'POST':

            switch($_POST['caso'])
            {   
                case 'XXXXXXXX' :
                    require_once "./Funciones/XXXXXXXX.php";
                break;

                case 'XXXXXXXXX' :
                    require_once "./Funciones/XXXXXXX.php";
                break;

                case 'XXXXXXXXX' :
                    require_once "./Funciones/XXXXXXXX.php";
                break;
            }
                    
            break;
        
        case 'GET':
            
            switch($_GET['caso'])
            {
                case 'XXXXXX':
                    require_once "./Funciones/XXXXXXXXX.php";
                break;

                case 'XXXXXXX':
                    require_once "./Funciones/XXXXXXX.php";
                break;

                case 'XXXXXXX' :
                    require_once "./Funciones/XXXXXXX.php";
                break;

                case 'XXXXXXX':
                    require_once "./Funciones/XXXXXXX.php";
                break;
            }
        break;
            
    }
?>
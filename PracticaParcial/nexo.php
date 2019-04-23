<?php
    $dato = $_SERVER['REQUEST_METHOD'];

    switch ($dato) {
        case 'POST':

            switch($_POST['caso'])
            {   
                case 'cargarProveedor' :
                    require_once "./Funciones/cargarProveedor.php";
                break;

                case 'hacerPedido' :
                    require_once "./Funciones/hacerPedido.php";
                break;

                case 'modificarProveedor' :
                    require_once "./Funciones/modificarProveedor.php";
                break;
            }
                    
            break;
        
        case 'GET':
            
            switch($_GET['caso'])
            {
                case 'consultarProveedor':
                    require_once "./Funciones/consultarProveedor.php";
                break;

                case 'proveedores':
                    require_once "./Funciones/proveedores.php";
                break;

                case 'listarPedidos' :
                    require_once "./Funciones/listarPedidos.php";
                break;

                case 'listarPedidoProveedor':
                    require_once "./Funciones/listarPedidoProveedor.php";
                break;
            }
        break;
            
    }
?>
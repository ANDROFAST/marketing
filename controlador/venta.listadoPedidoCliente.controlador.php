<?php
require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigo_cliente"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $codigocliente = $_POST['p_codigo_cliente'];
    
    $obj = new Venta();
    $datos = $obj->listarPedidosCliente($codigocliente);
    
    Funciones::imprimeJSON(200, "Ok", $datos);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


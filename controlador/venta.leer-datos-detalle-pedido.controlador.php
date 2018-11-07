<?php

require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    $np = $_POST['p_numero_pedido'];
    
    $obj = new Venta();
    $datos = $obj->consultaDetallePedido($np);
        echo json_encode($datos);
 //   Funciones::imprimeJSON(200, "Ok", json_encode($datos));
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


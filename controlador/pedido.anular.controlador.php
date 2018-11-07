<?php
require_once '../negocio/Pedido.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_numero_pedido"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $numero = $_POST['p_numero_pedido'];
    
    $obj = new Pedido();
    $datos = $obj->anular($numero);
    
    if ($datos == true) {
        Funciones::imprimeJSON(200, "Venta anulada correctamente", $datos);
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


<?php
require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_numero_venta"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $numero = $_POST['p_numero_venta'];
    
    $obj = new Venta();
    $datos = $obj->anular($numero);
    
    if ($datos == true) {
        Funciones::imprimeJSON(200, "Venta anulada correctamente", $datos);
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}



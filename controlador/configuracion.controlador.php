<?php

require_once '../negocio/Configuracion.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    
    $codigo = $_POST["codigo"];
    
    $obj = new Configuracion();
    $resultado = $obj->obtenerValorConfiguracion($codigo);
    
    Funciones::imprimeJSON(200, "Ok", $resultado);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
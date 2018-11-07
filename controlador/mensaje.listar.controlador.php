<?php

require_once '../negocio/Mensaje.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    $objMen = new Mensaje();
    $resultado = $objMen->listarTipoMensaje();
    
    Funciones::imprimeJSON(200, "", $resultado);

} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


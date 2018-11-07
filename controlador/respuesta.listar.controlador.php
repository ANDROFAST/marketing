<?php

require_once '../negocio/Respuestas.class.php';
require_once '../util/funciones/Funciones.clase.php';

try {
   
    $codigoRespuesta = $_POST["codigoRespuesta"];
    
    $objRespuesta = new Respuestas();
    $resultado = $objRespuesta->listar($codigoRespuesta);    
    Funciones::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {    
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


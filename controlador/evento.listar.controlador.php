<?php

require_once '../negocio/TipoEvento.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    $objTip = new TipoEvento();
    $resultado = $objTip->Listar();
    
    Funciones::imprimeJSON(200, "", $resultado);

} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


<?php

require_once '../negocio/TipoEvento.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigoTipoEvento"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $objTipoEvento = new TipoEvento();
    $codigoTipoEvento = $_POST["p_codigoTipoEvento"];
    $resultado = $objTipoEvento->leerDatos($codigoTipoEvento);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

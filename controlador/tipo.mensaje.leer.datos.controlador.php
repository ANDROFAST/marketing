<?php

require_once '../negocio/Mensaje.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigoMensaje"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $objMensaje = new Mensaje();
    $codigoMensaje = $_POST["p_codigoMensaje"];
    $resultado = $objMensaje->leerDatos($codigoMensaje);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

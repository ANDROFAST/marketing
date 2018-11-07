<?php

require_once '../negocio/Cliente.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigo"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $p_codigo = $_POST["p_codigo"];
    
    $obj = new Cliente();
    $resultado = $obj->leerClienteUsuario($p_codigo);
    
    Funciones::imprimeJSON(200, "ok", $resultado);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}



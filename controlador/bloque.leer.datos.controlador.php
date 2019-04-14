<?php

require_once '../negocio/Bloque.clase.php';

$codigoe = $_POST["p_codigoe"];
$codigob = $_POST["p_codigob"];

$obj = new Bloque();
try {
    $resultado = $obj->leerDatos($codigoe,$codigob);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


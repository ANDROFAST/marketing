<?php

require_once '../negocio/Distrito.clase.php';

$codigod = $_POST["p_codigod"];
$codigop = $_POST["p_codigop"];
$codigodis = $_POST["p_codigodis"];

$obj = new Distrito();
try {
    $resultado = $obj->leerDatos($codigod,$codigop,$codigodis);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


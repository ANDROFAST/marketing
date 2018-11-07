<?php

require_once '../negocio/Provincia.clase.php';

$codigod = $_POST["p_codigod"];
$codigop = $_POST["p_codigop"];

$obj = new Provincia();
try {
    $resultado = $obj->leerDatos($codigod,$codigop);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


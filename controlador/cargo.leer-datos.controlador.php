<?php

require_once '../negocio/Cargo.clase.php';

$codigo = $_POST["p_codigo"];

$objProvincia = new Cargo();
try {
    $resultado = $objProvincia->leerDatos($codigo);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


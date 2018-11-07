<?php

require_once '../negocio/Personal.clase.php';

$dni = $_POST["p_codigo"];

$objPersonal = new Personal();
try {
    $resultado = $objPersonal->leerDatos($dni);
    echo json_encode($resultado);
    //print_r($resultado);
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


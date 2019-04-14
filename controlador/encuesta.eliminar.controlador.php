<?php

$codigoE = $_POST["idEncuesta"];

require_once '../negocio/Encuesta.clase.php';
$obj = new Encuesta();

try {
    $obj->setId($codigoE);
    if ($obj->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


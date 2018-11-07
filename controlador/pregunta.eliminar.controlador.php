<?php

$codigoP = $_POST["codigoPregunta"];

require_once '../negocio/Preguntas.clase.php';
$obj = new Preguntas();

try {
    $obj->setCodigoPregunta($codigoP);
    if ($obj->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
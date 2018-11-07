<?php

require_once '../negocio/Preguntas.clase.php';

$codigo = $_POST["p_codigo"];

$obj = new Preguntas();
try {
    $resultado = $obj->leerDatos($codigo);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


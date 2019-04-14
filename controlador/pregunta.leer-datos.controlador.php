<?php

require_once '../negocio/Pregunta.clase.php';

$idencuesta = $_POST["p_idencuesta"];
$idbloque = $_POST["p_idbloque"];
$idpregunta = $_POST["p_idpregunta"];

$obj = new Pregunta();
try {
    $resultado = $obj->leerDatos($idencuesta,$idbloque,$idpregunta);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}

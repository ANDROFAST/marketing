<?php

require_once '../negocio/Articulo.clase.php';

$codigo = $_POST["p_codigo"];

$obj = new Articulo();
try {
    $resultado = $obj->leerDatos($codigo);
    echo json_encode($resultado);
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


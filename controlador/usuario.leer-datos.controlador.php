<?php

require_once '../negocio/Usuario.clase.php';

$codUsu = $_POST["p_codigo"];

$objUsuario = new Usuario();
try {
    $resultado = $objUsuario->leerDatos($codUsu);
    echo json_encode($resultado);
    //print_r($resultado);
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


<?php


$codigoD = $_POST["codigoDep"];

require_once '../negocio/Departamento.clase.php';
$objD = new Departamento();

try {
    $objD->setCodigoDepartamento($codigoD);
    if ($objD->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
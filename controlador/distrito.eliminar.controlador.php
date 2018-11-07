<?php


$codigod = $_POST["p_codigod"];
$codigop = $_POST["p_codigop"];
$codigodis = $_POST["p_codigodis"];

require_once '../negocio/Distrito.clase.php';
$objArea = new Distrito();

try {
    $objArea->setCodigoDep($codigod);
    $objArea->setCodigoProvincia($codigop);
    $objArea->setCodigoDistrito($codigodis);
    if ($objArea->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
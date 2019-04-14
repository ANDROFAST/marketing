<?php
$idbloque = $_POST["p_idbloque"];
$idencuesta = $_POST["p_idencuesta"];
$idpregunta = $_POST["p_idpregunta"];

require_once '../negocio/Pregunta.clase.php';
$objArea = new Pregunta();

try {
    $objArea->setCodigoBloque($idbloque);
    $objArea->setCodigoEncuesta($idencuesta);
    $objArea->setCodigoPregunta($idpregunta);
    if ($objArea->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
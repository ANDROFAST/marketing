<?php

$dni = $_POST["p_dni"];

require_once '../negocio/Personal.clase.php';
$objPersonal = new Personal();

try {
    $objPersonal->setDniPersonal($dni);
    if ($objPersonal->darBaja()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
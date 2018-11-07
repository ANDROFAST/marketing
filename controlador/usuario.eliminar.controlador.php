<?php

$codigoUsuario = $_POST["p_codigo_usuario"];

require_once '../negocio/Usuario.clase.php';
$objUsuario = new Usuario();

try {
    
    $objUsuario->setCodigoUsuario($codigoUsuario);
    if ($objUsuario->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
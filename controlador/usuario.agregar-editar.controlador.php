<?php
require_once '../negocio/Usuario.clase.php';

parse_str($_POST["p_datos_formulario"], $datosFrm);

$objUsuario = new Usuario();

$objUsuario->setDniUsuario($datosFrm["cbopersonal"]);
$objUsuario->setClave($datosFrm["txtcontrasenna"]); // en presentación el campo obligatorio tendrá que ser obligatorio
$objUsuario->setEstado($datosFrm["opcion_estado"]);

if ($datosFrm["txttipooperacion"]=="editar"){
    $objUsuario->setCodigoUsuario($datosFrm["txtcodigo_usuario"]);
}

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objUsuario->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objUsuario->editar()==true){
            echo "exito";  
      }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
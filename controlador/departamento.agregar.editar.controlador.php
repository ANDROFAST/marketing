<?php

require_once '../negocio/Departamento.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objProvincia = new Departamento();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProvincia->setCodigoDepartamento($datosFrm["txtcodigo"]);
}
$objProvincia->setNombre($datosFrm["txtdescrip"]);
try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objProvincia->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objProvincia->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
<?php

require_once '../negocio/Departamento.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objCargo = new Departamento();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoDepartamento($datosFrm["txtcodigo"]);
}
$objCargo->setNombre($datosFrm["txtdescrip"]);
try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objCargo->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objCargo->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
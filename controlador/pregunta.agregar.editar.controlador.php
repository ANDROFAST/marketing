<?php

require_once '../negocio/Preguntas.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objCargo = new Preguntas();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoPregunta($datosFrm["txtcodigo"]);
}
$objCargo->setDescripcion($datosFrm["txtdescrip"]);
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
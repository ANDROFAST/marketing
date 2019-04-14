<?php

require_once '../negocio/Provincia.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objProvincia = new Provincia();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProvincia->setCodigoProvincia($datosFrm["txtcodigo"]);    
}
$objProvincia->setNombre($datosFrm["txtdescrip"]);
$objProvincia->setCodigoDep($datosFrm["cbodepartamento"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objProvincia->agregar()==true){
            echo "exito";           /*
            echo $objCargo->getCodigoDep();
            echo $objCargo->getCodigoProvincia();
            echo $objCargo->getNombre()*/
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
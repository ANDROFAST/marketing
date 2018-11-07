<?php

require_once '../negocio/Provincia.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objCargo = new Provincia();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoProvincia($datosFrm["txtcodigo"]);    
}
$objCargo->setNombre($datosFrm["txtdescrip"]);
$objCargo->setCodigoDep($datosFrm["cbodepartamento"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objCargo->agregar()==true){
            echo "exito";           /*
            echo $objCargo->getCodigoDep();
            echo $objCargo->getCodigoProvincia();
            echo $objCargo->getNombre()*/
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
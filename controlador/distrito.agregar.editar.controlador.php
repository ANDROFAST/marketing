<?php

require_once '../negocio/Distrito.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objDistrito = new Distrito();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objDistrito->setCodigoDistrito($datosFrm["txtcodigo"]);    
}
$objDistrito->setNombre($datosFrm["txtdescrip"]);
$objDistrito->setCodigoDep($datosFrm["cbodepartamento"]);
$objDistrito->setCodigoProvincia($datosFrm["cboprovincia"]);    

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objDistrito->agregar()==true){
            echo "exito";           /*
            echo $objCargo->getCodigoDep();
            echo $objCargo->getCodigoProvincia();
            echo $objCargo->getNombre()*/
        }
    }else{
      if ($objDistrito->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
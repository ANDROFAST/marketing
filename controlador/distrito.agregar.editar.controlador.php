<?php

require_once '../negocio/Distrito.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objCargo = new Distrito();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoDistrito($datosFrm["txtcodigo"]);    
}
$objCargo->setNombre($datosFrm["txtdescrip"]);
$objCargo->setCodigoDep($datosFrm["cbodepartamento"]);
$objCargo->setCodigoProvincia($datosFrm["cboprovincia"]);    

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
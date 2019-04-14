<?php

require_once '../negocio/Pregunta.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objPregunta = new Pregunta();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objPregunta->setCodigoPregunta($datosFrm["txtcodigo"]);    
}
$objPregunta->setNombrePregunta($datosFrm["txtdescrip"]);
$objPregunta->setCodigoEncuesta ($datosFrm["cbodepartamento"]);
$objPregunta->setCodigoBloque($datosFrm["cboprovincia"]);    
$objPregunta->setOrdenPregunta($datosFrm["txtorden"]);  
try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objPregunta->agregar()==true){
            echo "exito";           /*
            echo $objCargo->getCodigoDep();
            echo $objCargo->getCodigoProvincia();
            echo $objCargo->getNombre()*/
        }
    }else{
      if ($objPregunta->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
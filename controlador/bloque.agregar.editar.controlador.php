<?php

require_once '../negocio/Bloque.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objBloque = new Bloque();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objBloque->setCodigoBloque($datosFrm["txtcodigo"]);    
}
$objBloque->setNombre($datosFrm["txtdescrip"]);
$objBloque->setCodigoEncuesta($datosFrm["cbodepartamento"]);
$objBloque->setOrden($datosFrm["txtorden"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objBloque->agregar()==true){
             echo "exito";  /*       
            echo $objCargo->getCodigoDep();
            echo $objCargo->getCodigoProvincia();
            echo $objCargo->getNombre()*/
        }
    }else{
      if ($objBloque->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
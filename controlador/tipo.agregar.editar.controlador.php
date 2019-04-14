<?php

require_once '../negocio/Tipo.clase.php';


parse_str($_POST["p_datosFormulario"], $datosFrm);

$objProvincia = new Tipo();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProvincia->setCodigoTipo($datosFrm["txtcodigo"]);
}
$objProvincia->setDescripcion($datosFrm["txtdescrip"]);
$objProvincia->setCodigoCategoria($datosFrm["txtcategoria"]);
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
}//require_once '../util/funciones/Funciones.clase.php';

/*
if (! isset($_POST["p_datosFormulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datosFormulario"];

//Convertir todos los datos que llegan concatenados a un array
parse_str($datosFormulario, $datosFormularioArray);

try {
    $objCargo = new Cargo();
    $objCargo->setDescripcion( $datosFormularioArray["txtdescripCar"] );
    
    if ($datosFormularioArray["txttipooperacion"]=="agregar"){
        $resultado = $objCargo->agregar();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }else{
        $objCargo->setCodigoCargo( $datosFormularioArray["txtcodigoCar"] );
        
        $resultado = $objCargo->editar();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
*/
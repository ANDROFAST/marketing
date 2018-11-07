<?php

require_once '../negocio/TipoEvento.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_datosFormulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datosFormulario"];

//Convertir todos los datos que llegan concatenados a un array
parse_str($datosFormulario, $datosFormularioArray);

try {
    $objEvento = new TipoEvento();
    $objEvento->setDescripcion( $datosFormularioArray["txtdescripEvento"] );
    
    if ($datosFormularioArray["txttipooperacion"]=="agregar"){
        $resultado = $objEvento->agregar();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }else{
        $objEvento->setCodigoEvento( $datosFormularioArray["txtcodigoEvento"] );
        
        $resultado = $objEvento->editar();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

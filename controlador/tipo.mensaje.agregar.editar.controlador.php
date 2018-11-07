<?php

require_once '../negocio/Mensaje.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_datosFormulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datosFormulario"];

//Convertir todos los datos que llegan concatenados a un array
parse_str($datosFormulario, $datosFormularioArray);

try {
    $objEvento = new mensaje();
    $objEvento->setTipoMensaje( $datosFormularioArray["txtdescripTMensaje"] );
    $objEvento->setMensaje( $datosFormularioArray["txtMensaje"] );
    
    if ($datosFormularioArray["txttipooperacion"]=="agregar"){
        $resultado = $objEvento->agregarMensaje();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }else{
        $objEvento->setCodigoMensaje( $datosFormularioArray["txtcodigoTMensaje"] );
        
        $resultado = $objEvento->editarMensaje();
        if ($resultado==true){
            Funciones::imprimeJSON(200, "Grabado correctamente", "");
        }
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

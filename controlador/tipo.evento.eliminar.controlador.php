<?php

    require_once '../negocio/TipoEvento.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if (! isset($_POST["codigoEvento"])){
	Funciones::imprimeJSON(500, "Faltan parametros", "");
	exit();
    }
    
    try {
        $objEvent = new TipoEvento();
        $codigoEvento = $_POST["codigoEvento"];
        $resultado = $objEvent->eliminar($codigoEvento);
        if ($resultado == true){
            //Eliminó correctamente
            Funciones::imprimeJSON(200, "El registro se ha eliminado satisfactoriamente", "");
        }
    } catch (Exception $exc) {
        Funciones::imprimeJSON(500, $exc->getMessage(), "");
    }
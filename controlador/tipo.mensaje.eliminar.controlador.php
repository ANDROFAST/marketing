<?php

    require_once '../negocio/Mensaje.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if (! isset($_POST["codigoMensaje"])){
	Funciones::imprimeJSON(500, "Faltan parametros", "");
	exit();
    }
    
    try {
        $objMen = new Mensaje();
        $codigoMensaje = $_POST["codigoMensaje"];
        $resultado = $objMen->eliminarMensaje($codigoMensaje);
        if ($resultado == true){
            //Eliminó correctamente
            Funciones::imprimeJSON(200, "El registro se ha eliminado satisfactoriamente", "");
        }
    } catch (Exception $exc) {
        Funciones::imprimeJSON(500, $exc->getMessage(), "");
    }
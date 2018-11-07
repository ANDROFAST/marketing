<?php

    //require_once 'sesion.validar.controlador.php';

    require_once '../negocio/Ubigeo.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
	$obj = new Ubigeo();
        $resultado = $obj->cargarDepartamentos();
	Funciones::imprimeJSON(200, "ok", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }

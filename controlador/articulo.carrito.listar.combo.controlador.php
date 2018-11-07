<?php

    //require_once 'sesion.validar.controlador.php';

    require_once '../negocio/Articulo.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if (! isset($_POST["p_codigo"])){
	Funciones::imprimeJSON(500, "Faltan parametros", "");
	exit();
    }
    
    try {
        $p_codigo = $_POST["p_codigo"];
        
	$obj = new Articulo();
        $resultado = $obj->cargaDatosCarrito($p_codigo);
	Funciones::imprimeJSON(200, "", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }

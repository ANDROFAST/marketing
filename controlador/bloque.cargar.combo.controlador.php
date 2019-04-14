<?php
    require_once '../negocio/Bloque.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if ( !isset( $_POST["p_prov"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    
    try {
        $p_prov = $_POST["p_prov"];
	$obj = new Bloque();
        $resultado = $obj->cargarBloquesPorEncuestas($p_prov);
	Funciones::imprimeJSON(200, "ok", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }

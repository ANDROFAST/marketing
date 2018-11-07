<?php
    require_once '../negocio/Ubigeo.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if ( !isset( $_POST["p_dep"] ) && !isset( $_POST["p_prov"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    
    try {
        $p_dep = $_POST["p_dep"];
        $p_prov = $_POST["p_prov"];
        
	$obj = new Ubigeo();
        $resultado = $obj->cargarDistritos($p_dep, $p_prov);
	Funciones::imprimeJSON(200, "ok", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }

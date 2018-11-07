<?php

require_once '../negocio/Articulo.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    
    if ( !isset( $_POST["codigoTipo"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    
    $codigoCategoria = $_POST["codigoCategoria"];
    $codigoTipo = $_POST["codigoTipo"];
    
    $objArticulo = new Articulo();
    $resultado = $objArticulo->listar($codigoCategoria, $codigoTipo);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

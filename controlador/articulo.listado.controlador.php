<?php

require_once '../negocio/Articulo.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    $codigoTipo = $_POST["codigoTipo"];
    $codigoCategoria = $_POST["codigoCategoria"];
    
    //$precio = $_POST["precio"];
    
    $objArticulo = new Articulo();
    
    $resultado = $objArticulo->cargaDatos($codigoCategoria,$codigoTipo );
    
    Funciones::imprimeJSON(200, "", $resultado);
        
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


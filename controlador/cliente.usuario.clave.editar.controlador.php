<?php

require_once '../negocio/Cliente.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if ( !isset( $_POST["p_codigo"] ) && !isset( $_POST["p_clave"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    
try { 
    $p_codigo = $_POST["p_codigo"];
    $p_clave = $_POST["p_clave"];
    
    $obj = new Cliente();
    $resultado = $obj->editarClienteUsuario($p_clave, $p_codigo);
    
    if( $resultado == true ){
            Funciones::imprimeJSON(200, "Contraseña actualizada correctamente", "");
    }

} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


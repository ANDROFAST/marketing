<?php
/*

    require_once '../negocio/TipoEvento.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
    $obj = new TipoEvento();
        $resultado = $obj->cargarTipoEvento();
        echo '<option value="">Seleccione un evento</option>';
        for ($i = 0; $i < count($resultado); $i++) {
            echo '<option value="'.$resultado[$i]["codigo_tipo_evento"].'">' . $resultado[$i]["descripcion"] . '</option>';
        }
    Funciones::imprimeJSON(200, "", $resultado);
    
    } catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
    
    }
*/



    require_once '../negocio/TipoEvento.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
    $obj = new TipoEvento();
        $resultado = $obj->cargarTipoEvento();
    Funciones::imprimeJSON(200, "", $resultado);
    
    } catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
    
    }
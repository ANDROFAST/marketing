<?php

require_once '../negocio/Ubigeo.clase.php';

$obj = new Ubigeo();

try {
    $p_prov = $_POST["p_prov"];
    $obj = new Ubigeo();
    $resultado = $obj->cargarProvinciasPorDepartamento($p_prov);
    echo '<option value="0">Seleccionar una Provincia</option>';
    
    for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_provincia"].'">'.$resultado[$i]["nombre"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


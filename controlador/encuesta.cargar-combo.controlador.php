<?php

require_once '../negocio/Encuesta.clase.php';

$obj = new Encuesta();

try {
    $p_encu = $_POST["p_encu"];
    $obj = new Encuesta();
    $resultado = $obj->cargarEncuestaBloque($p_encu);
    echo '<option value="0">Seleccionar una Encuesta</option>';
    
    for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["id_bloque"].'">'.$resultado[$i]["nombre_bloque"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}
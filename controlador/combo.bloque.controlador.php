<?php

require_once '../negocio/Bloque.clase.php';

$obj = new Bloque();

try {
    $resultado = $obj->cargarEncuestas();
    
     if ($_GET["modal"]== "si"){
        echo '<option value="">Seleccionar una encuesta</option>';
        
    }else{
        echo '<option value="0">Todos las encuestas</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["id_encuesta"].'">'.$resultado[$i]["nombre_encuesta"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

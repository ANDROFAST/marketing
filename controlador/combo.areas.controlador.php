<?php

require_once '../negocio/Area.clase.php';

$obj = new Area();

try {
    $resultado = $obj->listar();
    
     if ($_GET["modal"]== "no"){
        echo '<option value="">Seleccionar un área</option>';
        
    }else{
        echo '<option value="0">Todas las áreas</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["codigo_area"].'">'.$resultado[$i]["descripcion"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


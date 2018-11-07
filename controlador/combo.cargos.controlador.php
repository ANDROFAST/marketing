<?php

require_once '../negocio/Cargo.clase.php';

$obj = new Cargo();

try {
    $resultado = $obj->listar();
    
     if ($_GET["modal"]== "no"){
        echo '<option value="">Seleccionar un cargo</option>';
        
    }else{
        echo '<option value="0">Todos los cargos</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["codigo_cargo"].'">'.$resultado[$i]["descripcion"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


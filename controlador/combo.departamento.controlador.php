<?php

require_once '../negocio/Ubigeo.clase.php';

$obj = new Ubigeo();

try {
    $resultado = $obj->cargarDepartamentos();
    
     if ($_GET["modal"]== "si"){
        echo '<option value="">Seleccionar un departamento</option>';
        
    }else{
        echo '<option value="0">Todos los departamentos</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["codigo_departamento"].'">'.$resultado[$i]["nombre"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


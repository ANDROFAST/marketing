<?php

require_once '../negocio/Categoria.clase.php';

$obj = new Categoria();

try {
    $resultado = $obj->listar();
    
     if ($_GET["modal"]== "no"){
        echo '<option value="">Seleccionar una categoría</option>';
        
    }else{
        echo '<option value="0">Todas las categorías</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["codigo_categoria"].'">'.$resultado[$i]["descripcion"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


<?php

require_once '../negocio/Tipo.clase.php';

$obj = new Tipo();

$codigoCat = $_POST["p_codigo_categoria"];

try {
    $resultado = $obj->listarCombosModalPrin($codigoCat);
    
    if ($_POST["modal"] == "si"){
        echo '<option value="">Seleccione un tipo</option>';
    }else{    
        echo '<option value="0">Todos los tipos</option>';
    }
    
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["codigo_tipo"].'">'.$resultado[$i]["descripcion"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}



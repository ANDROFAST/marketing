<?php

require_once '../negocio/Personal.clase.php';

$obj = new Personal();

try {
    $resultado = $obj->listarCombo();
    
     if ($_GET["modal"]== "no"){
        echo '<option value="">Seleccionar un personal</option>';
        
    }else{
        echo '<option value="0">Todo el personal</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["dni"].'">'.$resultado[$i]["nombrepersonal"].'</option>';
    }    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

<?php

require_once '../negocio/Personal.clase.php';

$obj = new Personal();

try {
    $resultado = $obj->listarJefe();
    
     if ($_GET["modal"]== "no"){
        echo '<option value="">Seleccionar un Jefe</option>';
        
    }else{
        echo '<option value="0">Todo el personal</option>';
    }
    for ($i=0; $i < count($resultado); $i++){
        echo '<option value="'.$resultado[$i]["dni"].'">'.$resultado[$i]["nombre"].'</option>';
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

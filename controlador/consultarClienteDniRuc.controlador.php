<?php

require_once '../negocio/Cliente.clase.php';

$obj= new Cliente();

$valor=$_POST["p_valor"];
$valortp=$_POST["p_valortp"];

try {
    
    if(count($obj->buscardnirucexistente($valor,$valortp))>0){ 
        echo 'SE';      //El cliente ya existe con este dni o ruc
    }else{
        echo 'NE'; //Ok - no ha sido registrado anteriormente
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500"); //indicar al navegador que ha ocurrido un error     
    echo $ex->getMessage();//Imprimir el error                                
}

<?php


$codigoA = $_POST["codigoTipo"];

require_once '../negocio/Tipo.clase.php';
$objArea = new Tipo();

try {
    $objArea->setCodigoTipo($codigoA);
    if ($objArea->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
/*

    require_once '../negocio/Cargo.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    if (! isset($_POST["codigoCargo"])){
	Funciones::imprimeJSON(500, "Faltan parametros", "");
	exit();
    }
    
    try {
        $objCarg = new Cargo();
        $codigoCargo = $_POST["codigoCargo"];
        $resultado = $objCarg->eliminar($codigoCargo);
        if ($resultado == true){
            //Eliminó correctamente
            Funciones::imprimeJSON(200, "El registro se ha eliminado satisfactoriamente", "");
        }
    } catch (Exception $exc) {
        Funciones::imprimeJSON(500, $exc->getMessage(), "");
    }
    */
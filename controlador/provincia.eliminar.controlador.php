<?php


$codigod = $_POST["p_codigod"];
$codigop = $_POST["p_codigop"];

require_once '../negocio/Provincia.clase.php';
$objArea = new Provincia();

try {
    $objArea->setCodigoDep($codigod);
    $objArea->setCodigoProvincia($codigop);
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
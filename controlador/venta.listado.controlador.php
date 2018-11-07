<?php
require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_fecha1"]) ||
    ! isset($_POST["p_fecha2"]) ||
    ! isset($_POST["p_tipo"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $fecha1 = $_POST['p_fecha1'];
    $fecha2 = $_POST['p_fecha2'];
    $tipo = $_POST['p_tipo'];
    
    $obj = new Venta();
    $datos = $obj->listar($fecha1, $fecha2, $tipo);
    
    Funciones::imprimeJSON(200, "Ok", $datos);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


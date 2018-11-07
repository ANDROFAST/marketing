<?php
require_once '../negocio/Pedido.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once '../vista/sesion.validar.vista.php';

if (! isset($_POST["p_datosFormulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datosFormulario"];
$datosJsonDetalle = $_POST["p_datosJsonDetalle"];

//Convertir todos los datos que llegan concatenados a un array
parse_str($datosFormulario, $datosFormularioArray);

try {
  //  $codigoUsuarioSesion = $_SESSION["s_codigo_usuario"];
    
    $obj = new Pedido();
    $obj->setCodigoCliente($datosFormularioArray["txtcodigocliente"]);
    $obj->setFechaRegistro($datosFormularioArray["txtfec"]);
    $obj->setTotal($datosFormularioArray["txtimporteneto"]);
    $obj->setCodigoUsuario($codigoUsuario);
    $obj->setFechaEvento($datosFormularioArray["txtfechevent"]);
    $obj->setCodigoTipoEvento($datosFormularioArray["cboevento"]);
    $obj->setDireccionEvento($datosFormularioArray["txtdireccionevento"]);
        
    //enviar los datos del detalle en formato JSON
    $obj->setDetallePedido($datosJsonDetalle);
    
    $resultado = $obj->agregar();
    
    if( $resultado ){
        Funciones::imprimeJSON( 200, "La venta ha sido registrada satisfactoriamente", "");
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

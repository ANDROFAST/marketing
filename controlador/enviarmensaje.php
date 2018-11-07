<?php

require_once '../negocio/SmsGateway.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
parse_str($_POST["p_datosFormulario"], $datosFrm);

//$smsGateway = new SmsGateway('alexcespedessanchez@gmail.com', 'Sku353514');
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MTI5MjkwNiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjIzMzM4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.edIap_PyFStPBCcNfzMBgBoJtoHs9hlKc08THP07XuI";
$smsGateway = new SmsGateway($token);
$deviceID = 104540 ; // el id de mi dispositivo con mi cuenta 
$numero = $datosFrm['lbltelefonocliente'] ;
$mensaje = $datosFrm['mensaje'] ;

//if($datosFrm['mensaje']!='' && $datosFrm['lbltelefonocliente']!=''){
    
    $resultado = $smsGateway->sendMessageToNumber($numero, $mensaje, $deviceID);
//}
//    Funciones::imprimeJSON(200, "", $resultado);
    /*

    //agregar contactos para crear iduser - 34419 es el ingresado
    $smsGateway = new SmsGateway('gianmarco_185@hotmail.com', '72210475');
    $resultado = $smsGateway -> createContact ( 'Gianmarco Crisologo' , '51942950232' );
     
     */
    
    echo json_encode($resultado);
    

} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
<?php

$tipo_reporte = $_POST['tipo_reporte'];

if (isset($_POST['txtfecha1'])) {
    $fecha1 = $_POST['txtfecha1'];
} else {
    //$fecha1='01-01-01';}
    $fecha1 = date("d-m-y");
}

$fecha2 = (isset($_POST['txtfecha2']) ) ? $_POST['txtfecha2'] : date("d-m-y");

//$fecha1 = $_POST["txtfecha1"];
//$fecha2 = $_POST["txtfecha2"];
$tipo = $_POST['rbtipo'];
$top = $_POST["p_top"];
$tc = $_POST["opcion_cliente"];
//parse_str($_POST["p_array"], $datosForm);
//

require_once '../negocio/Cliente.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$obj = new Cliente();
try {
    $resultado = $obj->listarcliingresos($fecha1, $fecha2, $tipo, $top, $tc);
 
    $htmlDatosReporte = '<table border="1" align="center" cellpadding="3" cellspacing="0">';

    $htmlDatosReporte .= '<thead>';
    $htmlDatosReporte .= '<tr><td align=center colspan="8"> Desde: ' . $fecha1 . ' Hasta: ' . $fecha2 . '</td></tr>';
    $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td align=center colspan="8" class="titulo-reporte">REPORTE DE PEDIDOS TOP POR CLIENTES</td>';
    $htmlDatosReporte .= '</tr>';

    $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">FECHA</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">TIPO CLIENTE</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">CLIENTE</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">DIRECCIÓN</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">TELÉFONO MÓVIL</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">CANTIDAD PRODUCTOS</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">TOTAL</td>';

    $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';

    $htmlDatosReporte .= '<tbody>';
    $sumast = 0.0;
    $sumact = 0.0;

    for ($i = 0; $i < count($resultado); $i++) {

            $htmlDatosReporte .= '<tr color:black">';

            $sumast = $sumast + $resultado[$i]["importe"];

            $htmlDatosReporte .= '<td>' . $resultado[$i]["fecharegistro"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["tipo_clinte"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["cliente"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["direccion"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["telefonomovil"] . '</td>';
            $htmlDatosReporte .= '<td align=right>' . $resultado[$i]["cantidadcomprada"] . '</td>';
            $htmlDatosReporte .= '<td align=right>' . $resultado[$i]["importe"] . '</td>';

            $htmlDatosReporte .= '</tr>';
        
    }

    $htmlDatosReporte .= '<tr>';

    $htmlDatosReporte.= '<td colspan="6" align="right"><b>Total</b></td>';
    
    $htmlDatosReporte.= '<td align="center"> ' . $sumast . '</td>';
    $htmlDatosReporte .= '</tr>';

    $htmlDatosReporte .= '</tbody>';

    $htmlDatosReporte .= '</table>';

    $htmlReporte = Funciones::generarHTMLReporte($htmlDatosReporte);
    Funciones::generarReportes($htmlReporte, "landscape", $tipo_reporte, "reporte-cliente");
//    echo $tipo_reporte;
//    echo $htmlReporte;
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}



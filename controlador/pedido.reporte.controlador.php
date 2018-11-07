<?php
$tipo_reporte = $_POST["tipo_reporte"];

if (isset($_POST["txtfecha1"])) {
    $fecha1 = $_POST["txtfecha1"];
} else {
    //$fecha1='01-01-01';}
    $fecha1 = date("d-m-y");
}

$fecha2 = (isset($_POST["txtfecha2"]) ) ? $_POST["txtfecha2"] : date("d-m-y");

$tipo = $_POST["rbtipo"];
$top = $_POST["p_top"];
$tevento = $_POST["tipo_evento"];

require_once '../negocio/Pedido.clase.php';
require_once '../util/funciones/Funciones.clase.php';

$objPedido = new Pedido();
try {
    $resultado = $objPedido->reportePedido($fecha1, $fecha2, $tipo, $top, $tevento);
    
    $htmlDatosReporte = '<table border="1" align="center" cellpadding="3" cellspacing="0">';

    $htmlDatosReporte .= '<thead>';
    $htmlDatosReporte .= '<tr><td align=center colspan="8"> Desde: ' . $fecha1 . ' Hasta: ' . $fecha2 . '</td></tr>';
    $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td align=center colspan="8" class="titulo-reporte">REPORTE DE PRODUCTOS TOP POR VENTAS</td>';
    $htmlDatosReporte .= '</tr>';
    
     $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">TIPO CLIENTE</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">DOCUMENTO IDENTIDAD</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">CLIENTE</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">TIPO DE EVENTO</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">UNIDADES VENDIDAS</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">PRODUCTO</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">CANTIDAD PEDIDOS</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-pedido">MONTO</td>';

    $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';


    $htmlDatosReporte .= '<tbody>';
    $sumast = 0;

    for ($i = 0; $i < count($resultado); $i++) {
        
       $htmlDatosReporte .= '<tr color:black">';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["tipo_cliente"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["documento_identidad"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["cliente"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["evento"] . '</td>';
            $htmlDatosReporte .= '<td align="right">' . $resultado[$i]["unidades_vendidas"] . '</td>';
            $htmlDatosReporte .= '<td>' . $resultado[$i]["producto_precio"] . '</td>';
            $htmlDatosReporte .= '<td align="right">' . $resultado[$i]["cantidad_pedidos"] . '</td>';
            $htmlDatosReporte .= '<td align="right">' . $resultado[$i]["monto_total"] . '</td>';
            $htmlDatosReporte .= '</tr>'; 
    }
$htmlDatosReporte .= '<tr>';

    $htmlDatosReporte .= '</tr>';

    $htmlDatosReporte .= '</tbody>';

    $htmlDatosReporte .= '</table>';



    $htmlReporte = Funciones::generarHTMLReporte($htmlDatosReporte);

    Funciones::generarReportes($htmlReporte, "landscape", $tipo_reporte, "reporte-pedido");

    //echo $tipo;
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
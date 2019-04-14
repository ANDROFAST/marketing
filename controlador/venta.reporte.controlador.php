<?php

require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    $fecha = $_POST["fecha"];
    if( $fecha == '' ){
        $fecha = "11/11/1111";
    }
    $cliente = $_POST["txtcodigocl"];
    $comprobante = $_POST["cbotipoc"];
    
    $obj = new Venta();
    $resultado = $obj->reporteVneta($fecha, $cliente, $comprobante);
    
    $htmlDatosReporte = '<table border="0" cellpadding="3">';
    $htmlDatosReporte .= '<thead>';

        $htmlDatosReporte .= '<tr>';
            $htmlDatosReporte .= '<td colspan="8" class="titulo-reporte">REPORTE DE VENTAS</td>';
        $htmlDatosReporte .= '</tr>';

        $htmlDatosReporte .= '<tr>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">NUMERO VENTA</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">FECHA</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">COMPROBANTE</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">CLIENTE</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">PORCENTAJE IGV</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">SUB TOTAL</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">IGV</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">TOTAL</td>';
        $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';


    $htmlDatosReporte .= '<tbody>';
    
    for( $i = 0; $i < count($resultado); $i++ ){
        $htmlDatosReporte .= '<tr>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["nro"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["fecha"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["tipo"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["cliente"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["porc_igv"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["st"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["igv"].'</td>';
        $htmlDatosReporte .= '<td>'.$resultado[$i]["total"].'</td>';
        $htmlDatosReporte .= '</tr>';        
    }
    
    $htmlDatosReporte .= '</tbody>';
        
    $htmlDatosReporte .= '</table>';
    
    $htmlReporte = Funciones::generarHTMLReporte($htmlDatosReporte);
    
    $tipoReporte = $_POST['tipo_reporte'];//PDF-HTML-Excel
    
    Funciones::generarReporte($htmlReporte, $tipoReporte, "reporte-venta");
    
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "e");
}


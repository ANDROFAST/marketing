<?php
require_once '../negocio/Articulo.clase.php';

$obj = new Articulo();

//tem es el nombre del metodo de la libreria en jquery para el evento de buscar 
//en un txt
$valorBuscado = $_GET['term'];

$resultado = $obj->cargarDatosArticulo($valorBuscado);

$datos = array();

for( $i = 0; $i <count($resultado); $i++ ){
    $registro = 
            array(
                "label" => $resultado[$i]['nombre'],
                "value" => array(
                                "codigo" => $resultado[$i]['codigo_articulo'],
                                "nombre" => $resultado[$i]['nombre'],
                                "precio" => $resultado[$i]['precio_venta'],
                                "cantidad" => $resultado[$i]['stock']
                            )
            );
    
    $datos[$i] = $registro;
}

echo json_encode($datos);
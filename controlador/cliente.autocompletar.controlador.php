<?php
require_once '../negocio/Cliente.clase.php';

$obj = new Cliente();

//tem es el nombre del metodo de la libreria en jquery para el evento de buscar 
//en un txt
$valorBuscado = $_GET['term'];

$resultado = $obj->cargarDatosCliente($valorBuscado);

$datos = array();

for( $i = 0; $i <count($resultado); $i++ ){
    $registro = 
            array(
                "label" => $resultado[$i]['nombregeneral'],
                "value" => array(
                                "codigo" => $resultado[$i]['codigo_cliente'],
                                "nombre" => $resultado[$i]['nombregeneral'],
                                "direccion" => $resultado[$i]['direccion'],
                                "telefono" => $resultado[$i]['telefono_fijo'], 
                                "movil"  => $resultado[$i]['telefono_movil']
                            )
            );
    
    $datos[$i] = $registro;
}

echo json_encode($datos);
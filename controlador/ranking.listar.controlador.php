<?php

    require_once '../negocio/Venta.clase.php';

    $obj = new Venta();

    $codigoc= $_POST["p_cc"];
    try {
        $resultado = $obj->consultaRankingArticulosCompraCliente($codigoc);

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                    <th>ARTÍCULO</th>
                    <th>FRECUENCIA DE COMPRA</th>                    
                    <th style="text-align: center">CANT. COMPRADA</th>
                    <th style="text-align: center">CANT. DE TRANSACCIONES</th>
                    <th style="text-align: center">PORCENTAJE</th>
            </tr>
    </thead>
    <tbody>
        
        <?php
            for ($i = 0; $i < count($resultado); $i++) {
                echo '<tr>';
                echo '<td>'.$resultado[$i]["articulo"].'</td>';
                echo '<td>'.$resultado[$i]["frecuencia_compra"].'</td>';                
                echo '<td>'.$resultado[$i]["cantidad"].'</td>';                
                echo '<td>'.$resultado[$i]["cantidaddetransacciones"].'</td>';                
                echo '<td>'.$resultado[$i]["porcentaje"].'</td>';                
                /*
                 echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["codigo_area"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["codigo_area"].')"><i class="fa fa-close"></i></a>
                      </td>';
                */
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>ARTÍCULO</th>
                    <th>FRECUENCIA DE COMPRA</th>                    
                    <th style="text-align: center">CANT. COMPRADA</th>
                    <th style="text-align: center">CANT. DE TRANSACCIONES</th>
                    <th style="text-align: center">PORCENTAJE</th>
            </tr>
    </tfoot>
    
</table>
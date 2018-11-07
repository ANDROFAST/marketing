<?php

    require_once '../negocio/Area.clase.php';

    $obj = new Area();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>DESCRIPCIÓN</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </thead>
    <tbody>
        
        <?php
            for ($i = 0; $i < count($resultado); $i++) {
                echo '<tr>';
                echo '<td>'.$resultado[$i]["codigo_area"].'</td>';
                echo '<td>'.$resultado[$i]["descripcion"].'</td>';                
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["codigo_area"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["codigo_area"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>CODIGO</th>
                    <th>DESCRIPCIÓN</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </tfoot>
    
</table>
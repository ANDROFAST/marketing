<?php

require_once '../negocio/Usuario.clase.php';

    $obj = new Usuario();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                    <th>CÓDIGO</th>
                    <th>PERSONA</th>                    
                    <th>ESTADO</th>                    
                    <th>OPCIONES</th>                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i = 0; $i < count($resultado); $i++) {
                
                if($resultado[$i]["estado"]=='ACTIVO'){
                    echo '<tr>';
                }else{
                    echo '<tr  style="text-decoration:line-through; color:red">';
                }
                echo '<td>'.$resultado[$i]["codigo_usuario"].'</td>';
                echo '<td>'.$resultado[$i]["personal"].'</td>';                                
                echo '<td>'.$resultado[$i]["estado"].'</td>';                
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["codigo_usuario"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["codigo_usuario"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>CÓDIGO</th>
                    <th>PERSONA</th>                                    
                    <th>ESTADO</th>                    
                    <th>OPCIONES</th>                    
            </tr>
    </tfoot>
    
</table>

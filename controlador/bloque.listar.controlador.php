<?php

    require_once '../negocio/Bloque.clase.php';

    $obj = new Bloque();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listadob" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                   
                    <th>ORDEN.</th>                    
                    <th>NOMBRE DEL BLOQUE</th>
                    <th>ENCUESTA</th>                       
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </thead>
    <tbody>
        
        <?php
            for ($i = 0; $i < count($resultado); $i++) {
              
                echo '<tr>';
                echo '<td>'.$resultado[$i]["orden_bloque"].'</td>'; 
                echo '<td>'.$resultado[$i]["blo"].'</td>';     
                echo '<td>'.$resultado[$i]["enc"].'</td>';                                     
                               
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["id_encuesta"].','.$resultado[$i]["id_bloque"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["id_encuesta"].','.$resultado[$i]["id_bloque"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>ORDEN</th>
                    <th>NOMBRE DEL BLOQUE</th>                    
                    <th>ENCUESTA</th>                                     
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </tfoot>
    
</table>
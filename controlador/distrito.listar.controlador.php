<?php

    require_once '../negocio/Distrito.clase.php';

    $obj = new Distrito();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                    <th>COD. DEP</th>
                    <th>DEPARTAMENTO</th>                    
                    <th>COD. PROV.</th>                    
                    <th>PROVINCIA</th>                    
                    <th>COD. DIST.</th>                    
                    <th>DISTRITO</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </thead>
    <tbody>
        
        <?php
            for ($i = 0; $i < count($resultado); $i++) {
              
                echo '<tr>';
                echo '<td>'.$resultado[$i]["codigo_departamento"].'</td>'; 
                echo '<td>'.$resultado[$i]["dep"].'</td>';     
                echo '<td>'.$resultado[$i]["codigo_provincia"].'</td>';
                echo '<td>'.$resultado[$i]["prov"].'</td>';                                           
                echo '<td>'.$resultado[$i]["codigo_distrito"].'</td>';
                echo '<td>'.$resultado[$i]["dist"].'</td>';                                           
                               
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["codigo_departamento"].','.$resultado[$i]["codigo_provincia"].','.$resultado[$i]["codigo_distrito"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["codigo_departamento"].','.$resultado[$i]["codigo_provincia"].','.$resultado[$i]["codigo_distrito"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>COD. DEP</th>
                    <th>DEPARTAMENTO</th>                    
                    <th>COD. PROV.</th>                    
                    <th>PROVINCIA</th>                    
                    <th>COD. DIST.</th>                    
                    <th>DISTRITO</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </tfoot>
    
</table>
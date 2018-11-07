<?php

    require_once '../negocio/Personal.clase.php';

    $obj = new Personal();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                    <th>DNI</th>
                    <th>NOMBRE COMPLETO</th>                    
                    <th>DIRECCIÓN</th>                    
                    <th>TELÉFONO FIJO</th>                    
                    <th>TELÉFONO MÓVIL 1</th>                    
                    <th>TELÉFONO MÓVIL 2</th>                    
                    <th>EMAIL</th>                    
                    <th>ESTADO</th>                    
                    <th>CARGO</th>                    
                    <th>ÁREA</th>                    
                    <th>JEFE</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
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
                echo '<td>'.$resultado[$i]["dni"].'</td>';
                echo '<td>'.$resultado[$i]["apellido_paterno"].' '.$resultado[$i]["apellido_materno"].', '.$resultado[$i]["nombres"].'</td>';                
                echo '<td>'.$resultado[$i]["direccion"].'</td>';
                echo '<td>'.$resultado[$i]["telefono_fijo"].'</td>';
                echo '<td>'.$resultado[$i]["telefono_movil1"].'</td>';
                echo '<td>'.$resultado[$i]["telefono_movil2"].'</td>';
                echo '<td>'.$resultado[$i]["email"].'</td>';
                echo '<td align="center">'.$resultado[$i]["estado"].'</td>';
                echo '<td>'.$resultado[$i]["cargo"].'</td>';
                echo '<td>'.$resultado[$i]["area"].'</td>';
                echo '<td>'.$resultado[$i]["jefe"].'</td>';
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["dni"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["dni"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                    <th>DNI</th>
                    <th>NOMBRE COMPLETO</th>                    
                    <th>DIRECCIÓN</th>                    
                    <th>TELÉFONO FIJO</th>                    
                    <th>TELÉFONO MÓVIL 1</th>                    
                    <th>TELÉFONO MÓVIL 2</th>                    
                    <th>EMAIL</th>                    
                    <th>ESTADO</th>                    
                    <th>CARGO</th>                    
                    <th>ÁREA</th>                    
                    <th>JEFE</th>                    
                    <th style="text-align: center">OPCIONES</th>                                    
            </tr>
    </tfoot>
    
</table>

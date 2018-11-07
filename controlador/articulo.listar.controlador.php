<?php

    require_once '../negocio/Articulo.clase.php';

    $obj = new Articulo();

    try {
        $resultado = $obj->listar();

    } catch (Exception $exc) {
       echo $exc->getMessage();
    }

?>

<table id="tabla-listado" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
            <tr>
                
                    <th style="width:20%;text-align: center">IMAGEN</th>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>                    
                    <th>PRESENTACIÓN</th>                    
                    <th>PRECIO</th>                    
                    <th>STOCK</th>                    
                    <th>CATEGORÍA</th>                    
                    <th>TIPO</th>                    
                    <th>ESTADO</th>                    
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
                
                if (!file_exists ( "../imagenes/articulos/".$resultado[$i]["codigo_articulo"] .".jpg" ) ){
                    //$foto = "sin-foto.jpg";
                    echo '<td align="center"><img src="../imagenes/articulos/sin-foto.jpg" width="20%"/></td>';                                    
                }else{         
                           if(file_exists ( "../imagenes/articulos/".$resultado[$i]["codigo_articulo"] .".jpg" ) ){                
                              //$foto = $resultado[$i]["codigo_articulo"] .".jpg" ;                                           
                               echo '<td align="center"><img src="../imagenes/articulos/'.$resultado[$i]["codigo_articulo"].'.jpg" width="100"/></td>';                                    
                          }                     
                }                               
                echo '<td>'.$resultado[$i]["codigo_articulo"].'</td>';
                echo '<td>'.$resultado[$i]["nombre"].'</td>';                
                echo '<td>'.$resultado[$i]["presentacion"].'</td>';                
                echo '<td>'.$resultado[$i]["precio_venta"].'</td>';                
                echo '<td>'.$resultado[$i]["stock"].'</td>';                
                echo '<td>'.$resultado[$i]["cat"].'</td>';                
                echo '<td>'.$resultado[$i]["tip"].'</td>';                
                echo '<td>'.$resultado[$i]["estado"].'</td>';                
                echo '<td align="center">
                            <a href="javascript:void();" class="btn btn-warning btn-xs" onclick = "editar('.$resultado[$i]["codigo_articulo"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>
                            &nbsp;
                            <a href="javascript:void();" class="btn btn-danger btn-xs" onclick = "eliminar('.$resultado[$i]["codigo_articulo"].')"><i class="fa fa-close"></i></a>
                      </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <tr>
                 
                    <th style="width:20%;text-align: center">IMAGEN</th>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>                    
                    <th>PRESENTACIÓN</th>                    
                    <th>PRECIO</th>                    
                    <th>STOCK</th>                    
                    <th>CATEGORÍA</th>                    
                    <th>TIPO</th>                    
                    <th>ESTADO</th>                    
                    <th style="text-align: center">OPCIONES</th>                    
            </tr>
    </tfoot>
    
</table>
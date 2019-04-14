<?php
    require_once 'sesion.validar.vista.php';
    
    require_once '../util/funciones/definiciones.php';
    
    if($cargoUsuario=='ADMINISTRADOR' || $cargoUsuario=='JEFE DE SISTEMAS'){
        
    }else{
        header("location:principal.vista.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo C_NOMBRE_SOFTWARE; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
        <?php
        include 'estilos.vista.php';
    ?>

    </head>
    <body class="skin-blue layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
                include 'cabecera.vista.php';
            ?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 20px;">Mantenimiento de Artículos</h1>
                </section>

                <section class="content">
            <!-- INICIO del formulario modal -->
            <small>
            <form id="frmgrabar" name="frmgrabar" method="post" action="" enctype="multipart/form-data">
            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Título de la ventana</h4>
                  </div>
                  <div class="modal-body">
                  <input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control">
                  <div class="row">
                    <div class="col-xs-3">
                        <label>Código : <font color = "red">*</font></label>
                    <p><input type="text" name="txtcodigo" id="txtcodigo" class="form-control input-sm" placeholder="" readonly=""></p>
                    </div>
                    <div class="col-xs-9">
                        <label>Nombre: <font color = "red">*</font></label>
                    <p><input type="text" name="txtnombre" id="txtnombre" class="form-control input-sm" placeholder=""></p>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-6">
                        <label>Presentación: <font color = "red">*</font></label>
                    <p><input type="text" name="txtpresentacion" id="txtpresentacion" class="form-control input-sm" placeholder="" ></p>
                    </div>
                    <div class="col-xs-3">
                        <label>Precio: <font color = "red">*</font></label>
                    <p><input type="text" name="txtprecio" id="txtprecio" class="form-control input-sm" placeholder="" ></p>
                    </div>
                    <div class="col-xs-3">
                        <label>Stock: <font color = "red">*</font></label>
                    <p><input type="text" name="txtstock" id="txtstock" class="form-control input-sm" placeholder="" ></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                        <label> Categoría: <font color = "red">*</font></label>
                        <p>
                            <select class="form-control" name="txtcategoria" id="txtcategoria" required="required">

                            </select>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <label> Tipo: <font color = "red">*</font></label>
                        <p>
                            <select class="form-control" name="txttipo" id="txttipo" required="required">

                            </select>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <label> Estado: <font color = "red">*</font></label>
                        <p>
                            <select class="form-control" name="txtestado" id="txtestado" required="required">
                                <option value="">Seleccionar un estado</option>
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                        </p>
                        
                    </div>
                  </div>
                  
                  <p> <label>&nbsp;&nbsp;&nbsp;&nbsp;Foto del Articulo: </label>
                              <input type="file" name="txtfoto" id="txtfoto" class="form-control"><p>
                  
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-success" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
            </small>
            <!-- FIN del formulario modal -->

            <!-- INICIO del panel visualizador de imagen -->
                <div class="modal fade" id="miFoto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xs-12" id="tituloFoto">
                              </div>
                          </div>
                          
                          <div class="row">
                              <div class="col-xs-12" id="verFoto">
                                
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="text-center">
                                      <br>
                                      <a href="javascript:void()" onclick="cerrarFoto();"><b>Cerrar</b></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
        <!-- FIN del panel visualizador de imagen --> 
        
                    <div class="row">
                        
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar" onclick="agregar()"><i class="fa fa-copy"></i> Agregar nuevo Artículo</button>
                        </div>
                    </div>
                    <p>
                        <div class="box box-success">
                            <div class="box-body">
                                <div id="listado" class="table-responsive">
                                    
                                </div>
                            </div>
                        </div>
                    </p>
                </section>
            </div>
        </div><!-- ./wrapper -->

          
  <?php
        include 'scripts.vista.php';
    ?>
    
    <!--JS-->
    <script src="js/articulo_2.js" type="text/javascript"></script>
    <script src="js/validaciones.js"></script>
  

    </body>
</html>




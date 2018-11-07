<?php
    require_once 'sesion.validar.vista.php';
    
    require_once '../util/funciones/definiciones.php';
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
    <body class="skin-green layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
                include 'cabecera.vista.php';
            ?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 20px;">Mantenimiento de Usuarios</h1>
                </section>

                <section class="content">
            <!-- INICIO del formulario modal -->
            <small>
            <form id="frmgrabar">
            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Título de la ventana</h4>
                  </div>
                  <div class="modal-body">
                  <p><input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control" required=""><p>
                                                                    <div class="row">
                                                                      <div class="col-xs-3">
                                                                        <label>Código: </label>
                                                                        <p><input type="text" name="txtcodigo_usuario" id="txtcodigo_usuario" class="form-control" placeholder="Código" readonly=""></p>
                                                                      </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <label id="per" name="per"> Personal: </label>
                                                                            <p>
                                                                                <select class="form-control" name="cbopersonal" id="cbopersonal" >
                                                                                  
                                                                                </select>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                                                                                            
                                                                    <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <label> Contraseña: </label>
                                                                            <p><input type="password" name="txtcontrasenna" id="txtcontrasenna" class="form-control" placeholder="constraseña" maxlength="32" minlength="3" required=""><p>                                                               
                                                                        </div>
                                                                        
                                                                        <div class="col-xs-6">
                                                                            <label> Estado: </label>
                                                                            <p><select class="form-control" name="opcion_estado" id="opcion_estado" required="required">
                                                                                                    <option value="">Seleccionar un estado</option>
                                                                                                    <option value="A">ACTIVO</option>
                                                                                                    <option value="I">INACTIVO</option>
                                                                               </select>
                                                                            </p>
                                                                        </div>
                                                                    </div>                                                                    
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

                    <div class="row">
                        
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar" onclick="agregar()"><i class="fa fa-copy"></i> Agregar nuevo Usuario</button>
                        </div>
                    </div>
                    <p>
                        <div class="box box-success">
                            <div class="box-body">
                                <div id="listado">
                                    
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
    <script src="js/usuario_1.js" type="text/javascript"></script>
    <script src="js/validaciones.js"></script>
  

    </body>
</html>




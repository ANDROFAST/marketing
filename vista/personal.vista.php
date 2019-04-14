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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Mantenimiento de Personal</h1>
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
                  <div class="row">
                                                                    
                                                                    <div class="col-xs-5">
                                                                        <label> DNI: <font color = "red">*</font></label>
                                                                        <p><input type="text" class="form-control" name="txtdni_personal" id="txtdni_personal" placeholder="DNI del personal" required="" onkeypress="return permite(event, 'num')"
                                                                                  maxlength="8" minlength="8"/></p>
                                                                        <p><input type="hidden" class="form-control" name="txttipooperacion" id="txttipooperacion"
                                                                              placeholder="" required=""/></p>
                                                                    </div>
                                                                    
                                                                    <div class="col-xs-7">
                                                                        <label> Jefe: </label>
                                                                        <p>
                                                                            <select class="form-control" name="txtjefe" id="txtjefe">

                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <label> Apellido paterno: <font color = "red">*</font></label>
                                                                        <p><input type="text" class="form-control" name="txtapellido_paterno" id="txtapellido_paterno" onkeypress="return permite(event, 'car')"
                                                                                  placeholder="Apellido Paterno" required="" onkeyup="javascript:this.value=this.value.toUpperCase();" 
                                                                                  maxlength="30"/></p>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <label> Apellido materno: <font color = "red">*</font></label>
                                                                        <p><input type="text" class="form-control" name="txtapellido_materno" id="txtapellido_materno" onkeypress="return permite(event, 'car')"
                                                                                  placeholder="Apellido Materno" required="" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                                                  maxlength="30"/></p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <label> Nombres: <font color = "red">*</font></label>
                                                                        <p><input type="text" class="form-control" name="txtnombres" id="txtnombres" onkeypress="return permite(event, 'car')"
                                                                                  placeholder="Nombres" required="" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                                                  maxlength="30"/></p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <label> Teléfono fijo: </label>
                                                                        <p><input type="text" class="form-control" name="txttelefono_fijo" id="txttelefono_fijo"
                                                                                  placeholder="Teléfono fijo"
                                                                                  maxlength="9"/></p>
                                                                    </div>
                                                                </div>
                                                              
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <label> Dirección: <font color = "red">*</font></label>
                                                                        <p><input type="text" class="form-control" name="txtdireccion" id="txtdireccion" onkeypress="return permite(event, 'car')"
                                                                                  placeholder="Dirección" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                                                  maxlength="100"/></p>
                                                                    </div>
                                                                     <div class="col-xs-4">
                                                                        <label> Teléfono Móvil 1: </label>
                                                                        <p><input type="text" class="form-control" name="txttelefono_movil1" id="txttelefono_movil1"
                                                                                  placeholder="Teléfono móvil 1"
                                                                                  maxlength="9"/></p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <label> Correo electrónico: <font color = "red">*</font></label>
                                                                        <p><input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Correo electrónico" 
                                                                                  maxlength="50"/></p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <label> Teléfono Móvil 2: </label>
                                                                        <p><input type="text" class="form-control" name="txttelefono_movil2" id="txttelefono_movil2"
                                                                                  placeholder="Teléfono móvil 2" 
                                                                                  maxlength="9"/></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                          
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <label> Área: <font color = "red">*</font></label>
                                                                        <p>
                                                                            <select class="form-control" name="txtcodigo_area" id="txtcodigo_area" required="required">

                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <label> Cargo: <font color = "red">*</font></label>
                                                                        <p>
                                                                            <select class="form-control" name="txtcodigo_cargo" id="txtcodigo_cargo" required="required">

                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <label> Estado: <font color = "red">*</font></label>
                                                                        <p>
                                                                            <select class="form-control" name="txtestado_personal" id="txtestado_personal" required="required">
                                                                                <option value="">Seleccionar un estado</option>
                                                                                <option value="A">ACTIVO</option>
                                                                                <option value="I">INACTIVO</option>
                                                                            </select>
                                                                        </p>
                                                                    </div>                                                                    
                                                                </div>
                  <font color = "red">* Campos obligatorios</font>
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
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar" onclick="agregar(); cargarComboJefe();"><i class="fa fa-copy"></i> Agregar nuevo Personal</button>
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
    <script src="js/personal.js" type="text/javascript"></script>
  <script src="js/validaciones.js"></script>

    </body>
</html>




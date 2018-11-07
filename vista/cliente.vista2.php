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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Mantenimiento de Clientes</h1>
                </section>

                <section class="content">
                    <!-- Agregar modal -->
    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <form action="/" method="post" id="frmagregar" name="frmagregar">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-center">
                        <h4 class="modal-title" id="titulo_modal">Registrar clientes</h4>
                        <small class="font-bold">A continuación podrá gestionar un cliente</small>
                    </div>
                    <div class="modal-body modal-form">
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txtcodigo" id="txtcodigo" placeholder="Código" readonly=""/></p>
                            </div>
                            <p><input type="hidden" class="form-control" name="txttipooperacion" id="txttipooperacion"
                                      placeholder="" required=""/></p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p>
                                    <select class="form-control" name="opcion_cliente" id="opcion_cliente" required="">

                                    </select>
                                </p>
                            </div>
                            <div class="col-xs-6">
                                <p><input type="date" class="form-control" name="txtfecharegistro" id="txtfecharegistro"
                                          placeholder="Fecha Registro" required="" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"/></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <p><input type="text" class="form-control" autocomplete="off" name="txtruc" id="txtruc" onpaste="return false" 
                                          onkeypress=" return solonumeros(event)" placeholder="N° RUC" maxlength="11" pattern=".{11,}" required title="RUC no válido: 11 números"/></p>
                                
                            </div>
                            <div class="col-xs-8">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                          class="form-control" name="txtrazonsocial" id="txtrazonsocial"
                                          placeholder="Razón Social" maxlength="100" onpaste="return false"
                                          required title="Ingrese Razón Social"/></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="hidden" id="parsley-id-ruc">
                                <li class="list-group-item list-group-item-danger">
                             <!--       <font color="red">-->
                                    Este RUC ya ha sido registrado
                                <!--    </font>-->
                                </li>
                            </ul>                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <p><input type="text" class="form-control" autocomplete="off" name="txtdni" id="txtdni" placeholder="DNI de cliente" onkeypress=" return solonumeros(event)"
                                          maxlength="8" pattern=".{8,}" required title="DNI no válido: 8 números" onpaste="return false"/></p>
                                
                            </div>

                            <div class="col-xs-8">
                                <p><input type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                          class="form-control" name="txtnombres" id="txtnombres"
                                          placeholder="Nombres" onkeypress="return permite(event, 'car')" maxlength="30" onpaste="return false"
                                          required title="Ingrese Nombres"/></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="hidden" id="parsley-id-dni">
                                   <li class="list-group-item list-group-item-danger">
                                   <!--     <font color="red">-->
                                        Este DNI ya ha sido registrado
                                    <!--    </font>-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtapepaterno" id="txtapepaterno"
                                          placeholder="Apellido Paterno" onkeypress="return permite(event, 'car')" maxlength="50" required title="Ingrese Apellido Paterno"/></p>
                            </div>
                            <div class="col-xs-6">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtapematerno" id="txtapematerno"
                                          placeholder="Apellido Materno" onkeypress="return permite(event, 'car')" maxlength="50" onpaste="return false"
                                          required title="Ingrese Apellido Materno"/></p>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="email" class="form-control" name="txtcorreo" id="txtcorreo" placeholder="E mail" onpaste="return false" required=""  maxlength="50" /></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txtdireccion_web" id="txtdireccion_web" 
                                          maxlength="100" placeholder="Ingresar dirección web" onpaste="return false" /></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonofijo" id="txttelefonofijo"
                                          placeholder="Teléfono Fijo" 
                                          maxlength="9" minlength="9" /></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonomovil" id="txttelefonomovil"
                                    placeholder="Teléfono Móvil" required=""
                                    maxlength="9" minlength="9" />
                                </p>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtdireccion" id="txtdireccion"
                                          placeholder="Dirección" required="" maxlength="100" onpaste="return false"/></p>
                            </div>

                        </div>
                        <p>
				      Departamento <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodepartamentoamodal" id="cbodepartamentoamodal" required="" >

				      </select>
				  </p>
                                  
				  <p>
				      Provincia <font color = "red">*</font>
				      <select class="form-control input-sm" name="cboprovinciamodal" id="cboprovinciamodal" required="" >

				      </select>
				  </p>
				  <p>
				      Distrito <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodistritomodal" id="cbodistritomodal" required="" >

				      </select>
				  </p>
				  
                        <div class="row">
                            <div class="col-xs-6">
                                <p>
                                    <select class="form-control" name="opcion_estado" id="opcion_estado" required="required">
                                        <option value="">SELECCIONAR ESTADO</option>
                                        <option value="A">ACTIVO</option>
                                        <option value="I">INACTIVO</option>
                                    </select>
                                </p>
                            </div>
                        </div>
<p>
				      <font color = "red">* Campos obligatorios</font>
				  </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCerrarModal">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Guardar" id="btnAgregarModal"/>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Fin de modal -->

    <!-- Editar Cliente Natural-->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/" method="post" id="frmEditarNatural" name="frmEditarNatural">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-center">
                        <h4 class="modal-title" id="titulo_modal1">  </h4>
                        <small class="font-bold">A continuación podrá editar un cliente</small>
                    </div>
                    <div class="modal-body modal-form">
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txtcodigo1" id="txtcodigo1" placeholder="Código" /></p>
                            </div>

                            <p><input type="hidden" class="form-control" name="txttipooperacion1" id="txttipooperacion1"
                                      placeholder="" required=""/></p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="date" class="form-control" name="txtfecharegistro1" id="txtfecharegistro1"
                                          placeholder="Fecha Registro" required="" /></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control " name="txtdni1" id="txtdni1" placeholder="DNI de cliente" onkeypress=" return solonumeros(event)"
                                          maxlength="8" pattern=".{8,}" required title="DNI no válido: 8 números" onpaste="return false"/></p>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtapepaterno1" id="txtapepaterno1"
                                          placeholder="Apellido Paterno" onkeypress="return permite(event, 'car')" maxlength="50"
                                          required title="Ingrese Apellido Paterno" onpaste="return false"/></p>
                            </div>
                            <div class="col-xs-6">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtapematerno1" id="txtapematerno1"
                                          placeholder="Apellido Materno" onkeypress="return permite(event, 'car')" maxlength="50"
                                          required title="Ingrese Apellido Materno" onpaste="return false"/></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                          class="form-control" name="txtnombres1" id="txtnombres1"
                                          placeholder="Nombres" onkeypress="return permite(event, 'car')" maxlength="30"
                                          required title="Ingrese Nombres" onpaste="return false"/></p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="email" class="form-control" name="txtcorreo1" id="txtcorreo1" placeholder="E-mail" required="" maxlength="50"/></p>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonofijo1" id="txttelefonofijo1"
                                          placeholder="Teléfono Fijo" 
                                          maxlength="9" minlength="9"/></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonomovil1" id="txttelefonomovil1"
                                    placeholder="Teléfono Móvil" required="" 
                                    maxlength="9" minlength="9" />
                                </p>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtdireccion1" id="txtdireccion1"
                                          placeholder="Dirección" required="" maxlength="100"/></p>
                            </div>

                        </div> 

                        <p>
				      Departamento <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodepartamentoamodal1" id="cbodepartamentoamodal1" required="" >

				      </select>
				  </p>
                                  
				  <p>
				      Provincia <font color = "red">*</font>
				      <select class="form-control input-sm" name="cboprovinciamodal1" id="cboprovinciamodal1" required="" >

				      </select>
				  </p>
				  <p>
				      Distrito <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodistritomodal1" id="cbodistritomodal1" required="" >

				      </select>
				  </p> 

                        <div class="row">
                            <div class="col-xs-6">
                                <p>
                                    <select class="form-control" name="opcion_estado1" id="opcion_estado1" required="required">
                                        <option value="">Estado</option>
                                        <option value="A">ACTIVO</option>
                                        <option value="I">INACTIVO</option>
                                    </select>
                                </p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCerrarModal1">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Guardar" id="btnEditarModal"/>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Fin de modal -->

    <!-- Editar Cliente Jurídico-->
    <div class="modal fade" id="editarJuridicoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/" method="post" id="frmEditarJuridico" name="frmEditarJuridico">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-center">
                        <h4 class="modal-title" id="titulo_modal2">  </h4>
                        <small class="font-bold">A continuación podrá editar un cliente</small>
                    </div>
                    <div class="modal-body modal-form">
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txtcodigo2" id="txtcodigo2" placeholder="Código" /></p>
                            </div>

                            <p><input type="hidden" class="form-control" name="txttipooperacion2" id="txttipooperacion2"
                                      placeholder="" required=""/></p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="date" class="form-control" name="txtfecharegistro2" id="txtfecharegistro2"
                                          placeholder="Fecha Registro" required="" /></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txtrucc" id="txtrucc" placeholder="RUC de cliente" onkeypress=" return solonumeros(event)"
                                          maxlength="11" pattern=".{11,}" required title="RUC no válido: 11 números" onpaste="return false"/></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                          class="form-control" name="txtrazonsocial2" id="txtrazonsocial2"
                                          placeholder="Razón Social" onkeypress="return permite(event, 'car')" maxlength="100"
                                          required title="Ingrese Razón Social" onpaste="return false"/></p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="email" class="form-control" name="txtcorreo2" id="txtcorreo2" placeholder="E mail" required="" maxlength="50"/></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" class="form-control" name="txtdireccion_web2" id="txtdireccion_web2" placeholder="Dirección web" required="" maxlength="100"/></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonofijo2" id="txttelefonofijo2"
                                          placeholder="Teléfono Fijo" 
                                          maxlength="9" minlength="9" /></p>
                            </div>

                            <div class="col-xs-6">
                                <p><input type="text" class="form-control" name="txttelefonomovil2" id="txttelefonomovil2"
                                          placeholder="Teléfono Móvil" required="" 
                                          maxlength="9" minlength="9" /></p>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-xs-12">
                                <p><input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                          class="form-control" name="txtdireccion2" id="txtdireccion2"
                                          placeholder="Dirección" required="" maxlength="100"/></p>
                            </div>

                        </div> 
                       
                        <p>
				      Departamento <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodepartamentoamodal2" id="cbodepartamentoamodal2" required="" >

				      </select>
				  </p>
                                  
				  <p>
				      Provincia <font color = "red">*</font>
				      <select class="form-control input-sm" name="cboprovinciamodal2" id="cboprovinciamodal2" required="" >

				      </select>
				  </p>
				  <p>
				      Distrito <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbodistritomodal2" id="cbodistritomodal2" required="" >

				      </select>
				  </p>
                        <div class="row">
                            <div class="col-xs-6">
                                <p>
                                    <select class="form-control" name="opcion_estado2" id="opcion_estado2" required="required">
                                        <option value="">Estado</option>
                                        <option value="A">ACTIVO</option>
                                        <option value="I">INACTIVO</option>
                                    </select>
                                </p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer" id="mf">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCerrarModal2">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Guardar" id="btnEditarModal1"/>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Fin de modal -->


                    <div class="row">
                        
                        <div class="col-xs-3">
                            <button class="btn btn-success" data-toggle="modal" data-target="#agregarModal" href="javascript:void();" onclick="agregar()"><i class="fa fa-copy"></i> Agregar nuevo Cliente</button>
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
    <script src="js/cliente_5.js" type="text/javascript"></script>
    <script src="js/validaciones.js"></script>
    <script src="js/cargar-combos-cliente.js" type="text/javascript"></script>
    

    </body>
</html>




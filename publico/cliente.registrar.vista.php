
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core CSS -->
    
    <link href="../util/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../util/bootstrap/css/navbar-static-top.css" rel="stylesheet">
    <link href="../ant-util/util/bootstrap/css/navbar-static-top.css" rel="stylesheet">
    <link href="../ant-util/util/lte/css/AdminLTE.css" rel="stylesheet">
    <link href="../ant-util/util/lte/css/font-awesome.css" rel="stylesheet">
    <link href="../util/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../vista/css/checkbox.css" rel="stylesheet">
   <link href="../util/css/estilos-footer.css" rel="stylesheet">   
    <script src="../util/bootstrap/js/ie-emulation-modes-warning.js"></script>
   
    <!--sweetalert-->
    <script src="../util/swa/sweetalert-dev.js"></script>
    <!--sweetalert-->
    <link rel="stylesheet" href="../util/swa/sweetalert.css">
    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <?php
        require_once '../publico/publico.cabecera.vista.php';
    ?>
    
   <!---start-content----->
        <div class="content">
            <div class="main">
                <div class="border"></div>
                <div class="container">
                       <div class="register">
                               <form action="/" method="post" id="frmagregar" name="frmagregar"> 
                                      <!--<div class="">-->
                                      <div class="col-md-4 col-sm-12 col-xs-12">
                                          <br><br><br><br><br>
                                          <img src="../imagenes/logo.png" class="img-responsive center-block">
                                      </div>
                                      <div class="col-md-8 col-sm-12 col-xs-12">
                                          <div class="row">
                                                <div class="col-xs-6">
                                                    <p><input type="hidden" class="form-control" name="txtcodigo" id="txtcodigo" placeholder="Código" readonly=""/></p>
                                                </div>
                                                <p><input type="hidden" class="form-control" name="txttipooperacion" id="txttipooperacion"
                                                          placeholder="" required="" value="agregar"/></p>
                                            </div>
                                               
                                          <h3 style="text-align: center">TUS DATOS</h3>
                                          
                                          <div class="row col-md-12 col-sm-12 col-xs-12">
                                              <div class="col-md-6 col-sm-12 col-xs-12">
                                                  <span>TIPO DE CLIENTE<font color = "red">*</font></span>
                                                    <select class="form-control" name="opcion_cliente" id="opcion_cliente" required="">
                                                    </select>
                                              </div>
                                            </div>
<!--                                          <div class="row">-->
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <span>RUC<font font color = "red">*</font></span>
						<input type="text" class="form-control" autocomplete="off" name="txtruc" id="txtruc" onpaste="return false" 
                                                       onkeypress=" return solonumeros(event)" placeholder="N° RUC" maxlength="11" pattern=".{11,}" required title="RUC no válido: 11 números"/> 
                                            </div>
						
                                              <!--</div>-->
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                   <span>RAZÓN SOCIAL<font font color = "red">*</font></span>
                                                   <input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                                        class="form-control" name="txtrazonsocial" id="txtrazonsocial"
                                                        placeholder="Razón Social" maxlength="100" onpaste="return false"
                                                        required title="Ingrese Razón Social"/> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <ul class="hidden" id="parsley-id-ruc">
                                                    <li class="list-group-item list-group-item-danger">
                                                 <!--       <font color="red">-->
                                                        Este RUC ya ha sido registrado
                                                    <!--    </font>-->
                                                    </li>
                                                    </ul>                            
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
						<span>DNI<font font color = "red">*</font></span>
						<input type="text" class="form-control" autocomplete="off" name="txtdni" id="txtdni" placeholder="DNI de cliente" onkeypress=" return solonumeros(event)"
                                                       accesskey=""accept=""maxlength="8" pattern=".{8,}" required title="DNI no válido: 8 números" onpaste="return false"/> 
                                              </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <span>NOMBRES<font font color = "red">*</font></span>
                                                <input type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" 
                                                            class="form-control" name="txtnombres" id="txtnombres"
                                                            placeholder="Nombres" onkeypress="return permite(event, 'car')" maxlength="30" onpaste="return false"
                                                            required title="Ingrese Nombres"/> 
                                            </div>
                                            <div class="row">
                                              <div class="col-md-5 col-sm-12 col-xs-12">
                                                  <ul class="hidden" id="parsley-id-dni">
                                                     <li class="list-group-item list-group-item-danger">
                                                     <!--     <font color="red">-->
                                                          Este DNI ya ha sido registrado
                                                      <!--    </font>-->
                                                      </li>
                                                  </ul>
                                              </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <span>APELLIDO PATERNO<font font color = "red">*</font></span>
                                                    <input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                                            class="form-control" name="txtapepaterno" id="txtapepaterno"
                                                            placeholder="Apellido Paterno" onkeypress="return permite(event, 'car')" maxlength="50" required title="Ingrese Apellido Paterno"/> 
                                            </div>
                                             <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <span>APELLIDO MATERNO<font font color = "red">*</font></span>
                                                    <input type="text" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                                            class="form-control" name="txtapematerno" id="txtapematerno"
                                                            placeholder="Apellido Materno" onkeypress="return permite(event, 'car')" maxlength="50" onpaste="return false"
                                                            required title="Ingrese Apellido Materno"/> 
                                              </div>
                                             <div class="col-md-6 col-sm-12 col-xs-12">
                                                      <span>DIRECCION</span>
                                                      <input type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();"
                                                            class="form-control" name="txtdireccion" id="txtdireccion"
                                                            placeholder="Dirección" required="" maxlength="100" onpaste="return false"/> 
                                              </div>
                                              <div class="col-md-6 col-sm-12 col-xs-12">
                                                     <span>DIRECCION WEB<label>*</label></span>
                                                     <input type="text" class="form-control" name="txtdireccion_web" id="txtdireccion_web" 
                                                            maxlength="100" placeholder="Ingresar dirección web" onpaste="return false" /> 
                                              </div>
                                              <div class="col-md-6 col-sm-12 col-xs-12">
                                                      <span>TELEFONO FIJO</span>
                                                      <input type="text" class="form-control" name="txttelefonofijo" id="txttelefonofijo"
                                                                placeholder="Teléfono Fijo" maxlength="9" minlength="9" /> 
                                              </div>
                                             <div class="col-md-6 col-sm-12 col-xs-12">
                                                      <span>TELEFONO MOVIL<font color = "red">*</font></span>
                                                      <input type="text" class="form-control" name="txttelefonomovil" id="txttelefonomovil"
                                                            placeholder="Teléfono Móvil" required="" maxlength="9" minlength="9" /> 
                                              </div>
                                              
                                             
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                  <span>DEPARTAMENTO<font color = "red">*</font></span>
                                                  <select id="cbodepartamentoamodal" name="cbodepartamentoamodal" class="form-control" required="">

                                                  </select>
                                              </div>
                                              <div class="col-md-4 col-sm-12 col-xs-12">
                                                  <span>PROVINCIA<font color = "red">*</font></span>
                                                  <select id="cboprovinciamodal" name="cboprovinciamodal" class="form-control" required="">
                                                  </select>
                                              </div>
                                              <div class="col-md-4 col-sm-12 col-xs-12">
                                                  <span>DISTRITO<font color = "red">*</font></span>
                                                  <select id="cbodistritomodal" name="cbodistritomodal" class="form-control" required="">
                                                  </select>
                                              </div>
                                             
                                              <div class="clearfix"> </div>
                                              <div class="row">
                                                  <div class="col-md-6 col-sm-12 col-xs-12">
                                                      <!--<a class="news-letter" href="#">-->
                                                        <div class="checkbox">
                                                            <label style="font-size: 1.5em">
                                                                <input type="checkbox" name="condiciones" id="condiciones" value="0">
                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                Aceptar términos y condiciones
                                                            </label>
                                                        </div>
<!--                                                          &nbsp;<label class="checkbox"><input type="checkbox" name="condiciones" id="condiciones" value="0"><i> </i>
                                                              Aceptar términos y condiciones</label>-->
                                                        <!--</a>-->
                                                  </div>
                                              </div>
                                              <div class="register_account">
                                                <h3 style="text-align: center">DATOS DE INICIO DE SESIÓN</h3>
                                                <br>
                                                <!--<div class="col-md-12 col-sm-12 col-xs-12">-->
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <span>EMAIL<label>*</label></span>
                                                        <input type="email" class="form-control" name="txtcorreo" id="txtcorreo" placeholder="E mail" onpaste="return false" required=""  maxlength="50" /> 
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <span>CONTRASEÑA<font color = "red">*</font></span>
                                                        <input type="password" class="form-control" name="txtclave" id="txtclave" placeholder="CONTRASEÑA" required="">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <span>CONFIRMAR CONTRASEÑA<font color = "red">*</font></span>
                                                          <input class="form-control" type="password" name="txtclaveconfirmar" id="txtclaveconfirmar" placeholder="CONTRASEÑA" required="">
                                                    </div>
                                                <!--</div>-->
                                                
                                                      
                                                      
                                                <br>
                                                <div class="clearfix"> </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <br>
                                                   <!--<form>-->
                                                           &nbsp;<input type="submit" class="btn btn-primary" value="REGISTRAR" id="btnAgregarModal"/>
                                                           <div class="clearfix"> </div>
                                                   <!--</form>-->
                                                </div>
                                              </div>
                                       </div>
                                     </form>
                        </div>
                  </div>
            </div>
        </div>
    <!-- footer -->
        <?php
        include './footer.php';
        ?>
        <!-- /footer -->
    <?php
        include 'scripts.vista.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="../util/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../util/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    
<!--    <script src="js/cliente.usuario.js" type="text/javascript"></script>
    <script src="js/cargar-combos-cliente.js" type="text/javascript"></script>
    <script src="js/carrito.js" type="text/javascript"></script>-->
    
    <script src="../publico/js/cliente_publico.js"></script>
    <script src="../publico/js/validaciones.js"></script>
    <script src="../util/publico/sweet-alert/sweet-alert.js"></script>

</body>
</html>

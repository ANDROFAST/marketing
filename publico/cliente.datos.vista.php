    <?php
        session_name("loginUsuarioCliente");//nombre de la sesion del cliente
        session_start();
    ?>
    
    <div class="panel-group">
        <div class="col-sm-11">
            <h2>TUS DATOS</h2><hr>
            <section class="content">
            <small>
            <form id="frmgrabar">
                <div class="content-wrapper">
                    
                        
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                               <p>Nombres</p>
                                                <input type="text" class="form-control" id="txtnombre"> 
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                               <p>Apellidos</p>
                                                <input type="text" class="form-control" id="txtapellidos"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                               <p>Documento de identidad</p>
                                                <input type="text" class="form-control" id="txtdni"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                               <p>Dirección</p>
                                                <input type="text" class="form-control" id="txtdireccion"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                               <p>Teléfono</p>
                                                <input type="text" class="form-control" id="txttelef"> 
                                            </div>
                                        </div>
                                    </div>
                                    
<!--                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <p>Departamento</p>
                                                <select class="form-control input-sm" id="cbodepartamentoamodal" name="cbodepartamentoamodal" required="">
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <p>Provincia</p>
                                                <select class="form-control input-sm" id="cboprovinciamodal" name="cboprovinciamodal" required="">
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <p>Distrito</p>
                                                <select class="form-control input-sm" id="cbodistritomodal" name="cbodistritomodal" required="">
                                                </select>
                                            </div>
                                        </div>                      
                                    </div>-->
                                    <hr>
                                    
<!--                                    <div class="row">
                                        <div class="col-xs-4">
                                            <button type="button" class="btn btn-primary btn-block" id="btnagregarcl">ENVIAR 
                                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                                                                     
                    
                </div>
                
                <div class="content-wrapper" id="pnlMenu2">
                    <br>
                    <h2>TU CUENTA</h2><hr>
                   <div class="row">
                       <div class="col-xs-5">
                           <input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control">
                           <input type="hidden" name="txtweb" id="txtweb" class="form-control">
                           <input type="hidden" name="txtcodigo" id="txtcodigo" class="form-control">
                          <div class="form-group">
                              <p>Correo</p>
                              <input type="email" class="form-control" id="txtemail"> 
                          </div>
                      </div>
                   </div>
                    <a data-toggle="collapse" href="#demo">Cambiar contraseña</a><hr>
                    <div id="demo" class="collapse">
                        <div class="row">
                          <div class="col-xs-5">
                              <input type="password" class="form-control" id="txtpass1" placeholder="Nueva contraseña"> 
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-xs-5">
                              <input type="password" class="form-control" id="txtpass2" placeholder="Vuelva a escribir contraseña"> 
                          </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-4">
                          <br>
                          <button type="button" class="btn btn-primary btn-block" id="btnenviar">ENVIAR 
                          <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                      </div>
                    </div>
                  </div>
            </form>
                </small>
                </section> 
        </div>
    </div>

<!--JS-->
<script src="js/cargar-combos-cliente.js" type="text/javascript"></script>
<script src="js/cliente.usuario.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        leerDatosUsuario(<?php echo $_SESSION["scl_codigo_usuario"]; ?>);
    });
</script>


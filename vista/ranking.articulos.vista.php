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
	
	<!-- AutoCompletar-->
	<link href="../util/jquery/jquery.ui.css" rel="stylesheet">

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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Ranking de artículos más vendidos por cliente</h1>
                    
                </section>
		<small>
		    <section class="content">
                        
            <form id="frmgrabar">            
                    <div class="box box-success">
                        <div class="box-body">
                              
                              <div class="row">
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" class="form-control input-sm" id="txtcodigocliente" name="txtcodigocliente" readonly="" required="">
                                      </div>
                                  </div>
                                  <div class="col-xs-5">
                                      <div class="form-group">
                                        <label>Cliente (Digite las iniciales de los apellidos y nombres del cliente)</label>
                                        <input type="text" class="form-control input-sm" id="txtnombrecliente" required="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control input-sm" id="lbldireccioncliente" readonly="">
                                      </div>
                                  </div>
                                      
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Teléfono móvil</label>
                                        <input type="text" class="form-control input-sm" id="lbltelefonocliente" name="lbltelefonocliente" readonly="">
                                      </div>
                                  </div>                                  
                              
                              </div>
                            <div class="row">
                                <div class="col-xs-10">
                                    <div class="form-group">
                                        <textarea name="mensaje" id="mensaje" rows="5"  maxlength="140" class="form-control" placeholder="Escriba su pregunta aquí"></textarea>
                                    </div>                                        
                                </div> 
                                
                                <div class="col-xs-2" align="right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Enviar mensaje</button>
                                    </div>
                                </div>
                            </div>
                            
                          </div>
                    </div>
                    
                </form>     
                
                 
                     <div class="box box-success">
                        <div class="box-body">
                              
                              <div class="row">
                                  <div class="col-xs-1">
                                      <label>Soporte mínimo</label>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        
                                        <input type="text" class="form-control input-sm" id="txtsopminimo" name="txtsopminimo">
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <label>Confianza (%)</label>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        
                                        <input type="text" class="form-control input-sm" id="txtconfianza" name="txtconfianza">
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <label>Máximo de iteraciones</label>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">                                        
                                        <input type="text" class="form-control input-sm" id="txtmaxiteraciones" name="txtmaxiteraciones">
                                      </div>
                                  </div>
                    <form id="frmgenerarconocimiento">                           
                                  <div class="col-xs-2" align="center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" >Generar conocimiento</button>
                                    </div>
                                  </div>                                      
                     </form>       
                        <form id="frmgenerarreglas">            
                                  <div class="col-xs-2" align="center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" id="btngenerarconocimiento" name="btngenerarconocimiento">Generar reglas</button>
                                    </div>
                                  </div>
                        </form>
                              </div>                            
                          </div>
                    </div>
                        
                    <div class="box box-success">
                            <div class="box-body">
                                <div id="listadoRAC">

                                </div>
                            </div>
                    </div>
                    
                    
                </section>
		</small>
            </div>
	    
        </div><!-- ./wrapper -->
	<?php
	    //include 'scripts.vista.php';
	?>
		
        <!-- jQuery 2.1.3 -->
        <script src="../util/jquery/jquery.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>

	
	<!-- Archivos jquery para busqueda de AutoCompletar -->
	<script src="../util/jquery/jquery.ui.autocomplete.js"></script>
	<script src="../util/jquery/jquery.ui.js"></script>
	<script src="js/venta.autocompletar_1.js" type="text/javascript"></script>
	
	<!--JS-->
        <script src="js/ranking_articulos_3.js" type="text/javascript"></script>
        <!-- DATA TABLE -->
        <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- Scroll -->
        <script src="../util/scroll/jquery.nicescroll.min.js"></script>
        <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../util/lte/js/app.js" type="text/javascript"></script>

        <!--UTIL-->
        <script src="js/util.js" type="text/javascript"></script>

        <!--sweetalert-->
        <script src="../util/swa/sweetalert-dev.js"></script>

        <script>
            $("html").niceScroll();  // The document page (body)
        </script>

    </body>
</html>
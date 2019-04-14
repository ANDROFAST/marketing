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
    <body class="skin-blue layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
                include 'cabecera.vista.php';
            ?>

	    <form id="frmgrabar">
		<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 20px;">Registrar nuevo pedido</h1>
                    <ol class="breadcrumb">
                        <button type="button" class="btn btn-danger btn-sm" id="btnregresar">Regresar</button>
			<button type="submit" class="btn btn-primary btn-sm">Registrar el pedido</button>
                    </ol>
                </section>
		<small>
		    <section class="content">
                    <div class="box box-success">
                        <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Nº Pedido</label>
                                        <input type="text" class="form-control input-sm" readonly="" id="txtnro" name="txtnro"/>
                                      </div>
                                  </div>
                                 
                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Fecha de Pedido</label>
                                        <input type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>
                                  
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Evento</label>
                                     <select class="form-control input-sm" id="cboevento" name="cboevento" required="">
                                     </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Fecha de Evento</label>
                                        <input type="date" class="form-control input-sm" id="txtfechevent" name="txtfechevent" required="" min="<?php $fechaent=  date_create(date('Y-m-d')); date_add($fechaent, date_interval_create_from_date_string('30 days'));  echo date_format($fechaent, 'Y-m-d');?>" value="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Dirección del evento</label>
                                        <input type="text" class="form-control input-sm" id="txtdireccionevento" name="txtdireccionevento" maxlength="200"/>
                                      </div>
                                  </div>
                              </div><!-- /row -->
                              <div class="row">
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" class="form-control input-sm" id="txtcodigocliente" name="txtcodigocliente" readonly="">
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
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control input-sm" id="lbltelefonocliente" readonly="">
                                      </div>
                                  </div>                                  
                              </div>
                          <!-- /row -->
                          </div>
                    </div>
                    
                    
                    <div class="box box-success">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-5">
                                      <div class="form-group">
                                        <label>Digite las iniciales de un artículo que desea buscar</label>
                                        <input type="text" class="form-control input-sm" id="txtarticulo" />
                                        <input type="hidden" id="txtcodigoarticulo" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Precio de venta</label>
                                        <input type="text" class="form-control input-sm" id="txtprecio" readonly="" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Cantidad de venta</label>
                                        <input type="text" class="form-control input-sm" id="txtcantidad" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                        <br>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnagregar">Agregar</button>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12">
                                      <table id="tabla-listado" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">CÓDIGO</th>
                                                <th style="text-align: center">ARTÍCULO</th>
                                                <th style="text-align: center">PRECIO</th>
                                                <th style="text-align: center">CANTIDAD</th>
                                                <th style="text-align: center">DESCUENTO</th>
                                                <th style="text-align: center">IMPORTE</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="detallecompra">

                                        </tbody>
                                            
                                        
                                        
                                    </table>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="box box-success">
                          <div class="box-body">
                              <div class="row">                                  
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">NETO A PAGAR:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteneto" name="txtimporteneto" readonly="" style="width: 100px;"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                    
                </section>
		</small>
            </div>
	    </form>
        </div><!-- ./wrapper -->

	        <!-- jQuery 2.1.3 -->
<script src="../util/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>

	<!-- Archivos jquery para busqueda de AutoCompletar -->
	<script src="../util/jquery/jquery.ui.autocomplete.js"></script>
	<script src="../util/jquery/jquery.ui.js"></script>
	<script src="js/pedido_1.js" type="text/javascript"></script>
        <script src="js/pedido.autocompletar.js" type="text/javascript"></script>
	
	<!--JS-->
	<script src="js/cargar-combos.venta.js" type="text/javascript"></script>
        
	<!--<script src="js/util.js"></script>-->
        


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
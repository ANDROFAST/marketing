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
	<!-- AutoCompletar-->
	<link href="../util/jquery/jquery.ui.css" rel="stylesheet">
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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Reporte de ventas</h1>
                </section>

                <section class="content">
                    <form action="../controlador/venta.reporte.controlador.php" method="post" target="black">
                        <div class="row">
                            <div class="col-xs-3">
                                <input type="date" id="fecha" name="fecha" class="form-control input-sm"/>
                            </div>
                            <div class="col-xs-3">
                                <input type="hidden" name="txtcodigocl" id="txtcodigocl" class="form-control" value="0">
                                <input type="text" id="txtnombrecliente" name="txtnombrecliente" placeholder="Nombre del cliente" class="form-control input-sm"/>
                            </div>
                            <div class="col-xs-3">
                                <select id="cbotipoc" name="cbotipoc"  class="form-control input-sm">
                                    <option value="00">Seleccione comprobante</option>
                                    <option value="01">Factura</option>
                                    <option value="03">Boleta</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-copy"></i> Mostrar reporte</button>
                            </div>
                        </div>
                        
                        <br>
			<div class="row">
                            <div class="col-xs-12 form-inline">
				Formato de salida:&nbsp;
				<div class="radio">
                                    <label>
                                        <input type="radio" name="tipo_reporte" id="tipo_reporte" value="1" checked="" >
                                      HTML
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="tipo_reporte" id="tipo_reporte" value="2">
                                      PDF
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="tipo_reporte" id="tipo_reporte" value="3">
                                      Excel
                                    </label>
                                </div>
				
                                
                            </div>
                        </div>
                        
                    </form>
                </section>
            </div>
        </div><!-- ./wrapper -->
	<?php
	    include 'scripts.vista.php';
	?>
	
        	<!-- Archivos jquery para busqueda de AutoCompletar -->
	<script src="../util/jquery/jquery.ui.autocomplete.js"></script>
	<script src="../util/jquery/jquery.ui.js"></script>
	<script src="js/venta.autocompletar.js" type="text/javascript"></script>
	<!--JS-->
	<script src="js/cargar-combos.js" type="text/javascript"></script>
        <script src="js/articulo-reporte.js" type="text/javascript"></script>
    </body>
</html>
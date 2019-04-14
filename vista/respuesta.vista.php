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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Mantenimiento de respuestas</h1>
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
				<h4 class="modal-title" id="titulomodal">Agregar nueva respuesta</h4>
			      </div>
			      <div class="modal-body">
				  <input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control">
				  <div class="row">
				    <div class="col-xs-3">
					<p>Código respuesta<input type="text" name="txtcodigo" id="txtcodigo" class="form-control input-sm text-center text-bold" placeholder="" readonly=""></p>
				    </div>
				  </div>
				  <p>Respuesta <font color = "red">*</font>
				  	<input type="text" name="txtdescripcion" id="txtdescripcion" class="form-control input-sm" placeholder="" required=""><p>
				  <div class="row">
				    <div class="col-xs-3">
					<p>
					    Valor <font color = "red">*</font>
					    <input type="text" name="txtvalor" id="txtvalor" class="form-control input-sm" placeholder="" required="">
					<p>
				    </div>
				  </div>          
				  <p>
				      Pregunta <font color = "red">*</font>
				      <select class="form-control input-sm" name="cbopreguntamodal" id="cbopreguntamodal" required="" >

				      </select>
				  </p>
				 
				  <p>
				      <font color = "red">* Campos obligatorios</font>
				  </p>
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
                            <select id="cbopregunta" class="form-control input-sm"></select>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-copy"></i> Agregar nuevo artículo</button>
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
	<script src="js/cargar-combos.js" type="text/javascript"></script>
	<script src="js/respuesta_1.js" type="text/javascript"></script>

    </body>
</html>
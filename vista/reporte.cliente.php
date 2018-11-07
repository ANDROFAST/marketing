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
                    <h1 class="text-bold text-black" style="font-size: 20px;">Reporte de Pedidos por Clientes </h1>
                </section>

                <section class="content">

                    <p>
                        <div class="box box-success">
                            <div class="box-body">
                                
                                <form class="form-inline" name="frmreporte" action="../controlador/cliente.reporte.controlador.php" method="post" target="_blank">    
                            <div class="row">
                                <div class="col-xs-12">
                                    Solo Hoy&nbsp;<input type="radio" name="rbtipo" id="rbtipo" value="1" checked="" >&nbsp;&nbsp;&nbsp;
                                    <!--Solo Hoy&nbsp;<input type="radio" name="rbtipo" id="rbtipo" value="1" checked="" onchange="if(this.value=='1'){ document.getElementById('txtfecha1').value=<?php echo date("Y-m-d"); ?>;}" >&nbsp;&nbsp;&nbsp;-->
                                    Rango de Fechas&nbsp;<input type="radio" name="rbtipo" id="rbtipo" value="2" onchange="if(this.value=='2'){ document.getElementById('txtfecha1').required=true;}else{document.getElementById('txtfecha1').required=false;}">&nbsp;&nbsp;&nbsp;
                                    Todas las Fechas&nbsp;<input  type="radio" name="rbtipo" id="rbtipo" value="3">
                                </div>
                            </div>
                            &nbsp;<BR><BR>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>Desde:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input class="form-control input-sm" type="date" id="txtfecha1" name="txtfecha1" />
                                    </div><!-- /.input group -->

                                    &nbsp;
                                    <label>Hasta:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input class="form-control input-sm" type="date" id="txtfecha2" name="txtfecha2" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div><!-- /.input group -->

                                    &nbsp;
                                    <BR><BR>
                                    <label>Top de Datos: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="text-blue"><i class="fa fa-bar-chart-o"></i></span>
                                        </div>
                                        <input type="text" name="p_top" id="p_top" class="form-control input-sm" required=""/>
                                    </div>

                                    &nbsp;
                                    &nbsp;
                                    <label>Tipo Cliente:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="text-blue"><i class="fa fa-user"></i></span>
                                        </div>
                                        <select class="form-control input-sm" id="opcion_cliente" name="opcion_cliente" >
                                        </select>
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                            <BR><BR>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>Formato de salida:&nbsp;</label>
                                    HTML&nbsp;<input type="radio" name="tipo_reporte" id="tipo_reporte" value="1" checked="checked">&nbsp;&nbsp;&nbsp;
                                    PDF&nbsp;<input type="radio" name="tipo_reporte" id="tipo_reporte" value="2">&nbsp;&nbsp;&nbsp;
                                    Excel&nbsp;<input type="radio" name="tipo_reporte" id="tipo_reporte" value="3">

                                </div>
                                &nbsp;
                                <div class="input-group">
                                    <button type="submit" class="btn btn-danger">Generar</button>
                                </div><!-- /.input group -->
                            </div>
                        </form>
                                
                                
                                
                                
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
      <script src="../vista/js/combo_cliente.js"></script>
    <!--<script src="../publico/js/cargar-combos-cliente.js" type="text/javascript"></script>-->
    <!--<script src="../publico/js/distrito.js" type="text/javascript"></script>-->
    <!--<script src="js/validaciones.js"></script>-->
    <!--<script src="js/cargar-combos-cliente.js" type="text/javascript"></script>-->
    

    </body>
</html>




﻿<?php
    require_once '../publico/sesion.cliente.validar.vista.php';
    require_once '../util/funciones/estadoSesion.php';
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>Producciones Nitro</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
    
    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!--sweetalert-->
    <script src="../util/swa/sweetalert-dev.js"></script>
    <!--sweetalert-->
    <link rel="stylesheet" href="../util/swa/sweetalert.css">
    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
 
        <?PHP
        require_once '../publico/publico.cabecera.vista.php';
    ?>  
    <!-- Page Content -->
    <div class="container">
         <!-- Barra de navegación -->
         <br> <br> <br>
      <!-- Page Heading/Breadcrumbs -->
     <h1 class="mt-4 mb-3 text-warning" >Carrito
        <small>de Compras</small>
      </h1>
    <form id="frmgrabar">
  <div class="row">
    <div class="col-sm-9">
        <table width="100%">
            <tr>
                <td style="vertical-align:bottom;">CANTIDAD AÑADIDA (<label id="lblnum"></label>)</td>
                <td style="text-align:right; vertical-align:bottom;">
                    <a href="../publico/publico.principal.vista.php" style="text-decoration:none">Seguir comprando</a>
                </td>
            </tr>
        </table>
        
         <?php
                require_once '../publico/sesion.cliente.validar.vista.php';
                require_once '../util/funciones/estadoSesion.php';
                $fechaActual= date('Y-m-d');
                $fechaent=  date_create(date('Y-m-d')); 
                date_add($fechaent, date_interval_create_from_date_string('30 days')); 
                $fechaEventomin= date_format($fechaent, 'Y-m-d');
                if( $GLOBALS['isLogin'] == 0 ){
                    echo '';
                }else if( $GLOBALS['isLogin'] == 1 ){
                    session_name("loginUsuarioCliente");//nombre de la sesion del cliente
                    
                    echo '<div class="box box-success">
                        <div class="box-body">
                              <div class="row">
                                  
                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Fecha de Pedido</label>
                                        <input readonly="" type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="'.$fechaActual.'" min="'.$fechaActual.'"/>
                                      </div>
                                  </div>                                  
                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Evento</label>
                                     <select class="form-control input-sm" id="cboevento" name="cboevento" required="" value="">
                                     </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                        <div class="form-group">
                                          <label>¿Para quién será dirigido el evento?</label>
                                          <input type="text" required="" class="form-control input-sm" placeholder="Ejmp:Papá, mamá, hijo, sobrino, etc" id="txteventodirigidoa" name="txteventodirigidoa" maxlength="200"/>
                                        </div>
                                    </div>
                              </div>
                          </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                          <label>Fecha de Evento</label>
                          <input type="date" class="form-control input-sm" id="txtfechevent" name="txtfechevent" required="" min="'.$fechaEventomin.'" value="'.$fechaEventomin.'"/>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="form-group">
                          <label>Dirección del evento</label>
                          <input type="text" class="form-control input-sm" id="txtdireccionevento" name="txtdireccionevento" maxlength="200"/>
                        </div>
                    </div>
                    
                </div>
            </div>
                
            </div>';
                }
            ?>
            
        
        <table class="table" >
         <tbody id="detallePedido">
          </body>
        </table>
        <hr width="90%"/>
    </div>
      <br><br><br>
    <div class="col-sm-3">
      <div class="panel-group">
        <div class="panel panel-default">
            <!--Para verificar si el usuario ya inicio sesion-->
            <input type="hidden" name="txtlogincliente" id="txtlogincliente" class="form-control" value="<?php echo $GLOBALS['isLogin']; ?>">
            <div class="panel-heading"><b>RESUMEN DE PEDIDO</b></div>
            <div class="panel-body">
                <div class="panel-heading"><label id="lblnro"></label> ARTÍCULO(S)<br></div>
                
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Costo total:</td>
                            <td style="text-align:right;"><label aling="rigth" id="lblct" ></label></td>
                        </tr>
                        <tr>
                            <td>Descuento</td>
                            <td style="text-align:right;"><label id="lbldsct" ></label></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td style="text-align:right;"><label id="lbltl" name="lbltl"></label></td>
                        </tr>
                    </table>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" id="btnnext" 
                        >CONFIRMAR 
                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
    <!-- /.container -->

    <!-- Footer -->
  <!--  <footer class="py-5 bg-dark  footer navbar-fixed-bottom">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container 
    </footer> -->

    <!-- Bootstrap core JavaScript -->
    <script src="../util/bootstrap/vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../util/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

     <?php
	include 'scripts.vista.php';
    ?>
    <!--sweetalert-->
<script src="../util/swa/sweetalert-dev.js"></script>
    <script src="js/carrito.js" type="text/javascript"></script>
    
   
    <!--<script src="js/catalogo.js" type="text/javascript"></script>-->
  </body>

</html>



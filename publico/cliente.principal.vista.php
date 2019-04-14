<?php 
    require_once './sesion.cliente.validar.vista.php';
    require_once '../util/funciones/estadoSesion.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Web de compras</title>

    <!-- Bootstrap core CSS -->
    <link href="../util/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../util/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="../util/bootstrap/js/ie-emulation-modes-warning.js"></script>
    <!--sweetalert-->
    <script src="../util/swa/sweetalert-dev.js"></script>
    <!--sweetalert-->
    <link rel="stylesheet" href="../util/swa/sweetalert.css">
    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <!-- Barra de navegación -->
    <?PHP
        require_once '../publico/publico.cabecera.vista.php';
    ?>
    <!------------------------>
    <div class="container">
        <br>    <br>    <br>    <br>
<!--        <div class="row" id="pnImagen">
             se llena desde javascript 
        </div>-->
        <div class="panel-group">
            <div class="col-sm-3">
                <div class="panel-group">
                <div class="panel-body">
                <div class="list-group">
                    <a href="" class="list-group-item active">MI CUENTA</a>
                    <a href="javascript:cargaDatos()" class="list-group-item">Datos personales</a>
                    <a href="#pnlMenu2" class="list-group-item">Cuenta</a>
                    <a href="#pnlMenu2" class="list-group-item">Encuesta</a>
                </div>
                
                <div class="list-group">
                    <a href="#" class="list-group-item active">INFORMACIÓN DEL PEDIDO</a>
                    <a href="../publico/carrito.vista.php" class="list-group-item">Carrito de compras</a>
                    <a href="javascript:cargaPedidos()" class="list-group-item">Historial de pedidos</a>
                    <a href="#" class="list-group-item">Seguimiento de tu pedido</a>
                </div>
                </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="panel-group">
                    <div class="panel-body" id="pnlMenu">
                        <h3>HOLA, BIENVENIDO</h3><hr> 
                    </div>
                </div>
                <div class="panel-group">
                    <div class="panel-body" id="pnlMenu2">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
	include 'scripts.vista.php';
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../util/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../util/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    
    <script src="js/menu-cliente.js" type="text/javascript"></script>

  </body>
</html>

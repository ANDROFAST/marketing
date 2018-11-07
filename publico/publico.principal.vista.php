
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

    <title>Catálogo de productos</title>

    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core CSS -->
    <!--
    <link href="../util/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../util/bootstrap/css/navbar-static-top.css" rel="stylesheet">
    <link href="../util/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="../util/bootstrap/js/ie-emulation-modes-warning.js"></script>
    -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
        <div class="row" id="pnImagen">
            <!-- se llena desde javascript -->
        </div>
    </div> <!-- /container -->
<button type="button" class="btn btn-success" aria-hidden="true" id="btndelete"><i class="fa fa-save"></i> Borrar
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  </button>
    <small>
	<form id="frmgrabar">
            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
			<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="titulomodal">AÑADIR ARTICULO AL CARRITO</h4>
			</div>
			<div class="modal-body">                          
                            <input type="hidden" name="txtproductos" id="txtproductos" class="form-control">
                            <input type="hidden" name="txtcodigoa" id="txtcodigoa" class="form-control">
                            <div class="row">
                                  <div class="col-xs-12">
                                      <table width border="0" style="border-collapse: separate; border-spacing: 25px 5px">
                                        <thead>                                          
                                        </thead>                                       
                                        <tbody id="detallecompra">
                                            <tr>
                                                <td style="text-align: center"><img id="imgFoto" height="100"/></td>
                                                <td style="text-align: center"><label id="lblarticulo"></label></td>
                                                <td style="text-align: center"><label id="lblprecio"></label></td>
                                                <td style="text-align: center"><input type="number" name="txtcantidad" id="txtcantidad" min="1" max="15" value="1" class="form-control"></td>
                                            </tr>
                                        </tbody>    
                                    </table>
                                  </div>
                              </div>
			</div>
			<div class="modal-footer">
                            <button type="button" class="btn btn-success" aria-hidden="true" id="btnadd"><i class="fa fa-save"></i> Añadir al carrito
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  </button>
                            <button type="button" class="btn btn-success" aria-hidden="true" id="btnview"><i class="fa fa-save"></i> Ver carrito
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  </button>
			</div>
                    </div>
		</div>
            </div>
        </form>
    </small>
    
    <?php
	include 'scripts.vista.php';
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../util/bootstrap/js/bootstrap.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../util/bootstrap/js/ie10-viewport-bug-workaround.js"></script>-->    
    <script src="js/catalogo_1.js" type="text/javascript"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="es">

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
    <link href="../util/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="../util/bootstrap/css/modern-business.css" rel="stylesheet" type="text/css"/>

    <!--sweetalert-->
    <script src="../util/swa/sweetalert-dev.js"></script>
    <!--sweetalert-->
    <link rel="stylesheet" href="../util/swa/sweetalert.css">
    <link href="../util/bootstrap/css/dropdown.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="publico.principal.vista.php"> <img src="../imagenes/img/logo-1.png" alt=""/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="publico.principal.vista.php">Inicio</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="catalogo.principal.vista.php">Catalogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="galeria.principal.vista.php">Galeria</a>
            </li>
             <li class="nav-item dropdown">
               <a class="nav-link" href="contact.html">Contacto</a>
            </li>
            <li>
              <?php
                require_once '../publico/sesion.cliente.validar.vista.php';
                require_once '../util/funciones/estadoSesion.php';
                require_once '../negocio/Tipo.clase.php';
                if( $GLOBALS['isLogin'] == 0 ){
                    echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="../publico/cliente.registrar.vista.php"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Registrarse</a></li>
                        <li><a href="#" onclick="abrirIS()"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar sesión</a></li>
                    </ul>';
                }else if( $GLOBALS['isLogin'] == 1 ){
                    session_name("loginUsuarioCliente");//nombre de la sesion del cliente
                    
                    echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="../controlador/sesioncl.cerrar.controlador.php"> CERRA SESIÓN</a></li>
                        <li><a href="../publico/cliente.principal.vista.php">HOLA '. $_SESSION["nombre_usuario"] .' <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                    </ul>';
                }
            ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
     <h1 class="mt-4 mb-3 text-warning" >Catalogo
        <small>de Servicios</small>
      </h1>

      <ol class="breadcrumb">
       <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>
                <ul class="dropdown-menu" id="cboc">             
                    <?php
                        require_once '../negocio/Categoria.clase.php';

                        $obj = new Categoria();
                        $resultado = $obj->listar();

                        for( $i = 0; $i < count($resultado); $i++ ){
                            echo '<li value = "'. $resultado[$i]['codigo_categoria'] .'"><a href="#">'. $resultado[$i]['descripcion'] .'</a></li>';
                        }
                    ?>
                </ul>
       </li>
       <div class="col-md-1 offset-md-1"></div>
       <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tipo <span class="caret"></span></a>
                <ul class="dropdown-menu" id="cbol">
                    
                    <?php
                        require_once '../negocio/Tipo.clase.php';

                        $obj = new Tipo();
                        $resultado = $obj->cargarListaDatos();

                        for( $i = 0; $i < count($resultado); $i++ ){
                            echo '<li value = "'. $resultado[$i]['codigo_tipo'] .'"><a href="#">'. $resultado[$i]['descripcion'] .'</a></li>';
                        }
                    ?>
                </ul>
        </li>
      </ol>

      <!-- Image Header -->
      <!--<img class="img-fluid rounded mb-4" src="http://placehold.it/1200x300" alt=""> -->
 
    <div class="container">
        <div class="row" id="pnImagen" >
            <!-- se llena desde javascript -->
        </div>
    </div> <!-- /container -->
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
<button type="button" class="btn btn-success" aria-hidden="true" id="btndelete"><i class="fa fa-save"></i> Borrar
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
 </button>
    <small>
	<form id="frmgrabar">
            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
			<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="Close">&times;</button>
                            <h4 class="modal-title" id="titulomodal">AÑADIR ARTICULO AL CARRITO</h4>
			</div>
			<div class="modal-body">                          
                            <input type="hidden" name="txtproductos" id="txtproductos" class="form-control">
                            <input type="hidden" name="txtcodigoa" id="txtcodigoa" class="form-control">
                            <div class="row">
                                  <div class="col-xs-12">
                                      <table width border="0" >
                                        <thead>                                          
                                        </thead>                                       
                                        <tbody id="detallecompra">
                                            <tr>
                                               <th rowspan="2"><img id="imgFoto" class="img-fluid"/></th>
                                               <th></th>
                                            </tr>
                                            <tr>
                                                <td ><label id="lblarticulo"></label></td>
                                                <td ><label id="lblprecio"></label></td>
                                                <td ><input type="number" name="txtcantidad" id="txtcantidad" min="1" max="15" value="1" class="form-control"></td>
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
                            <button type="button" class="btn btn-success" aria-hidden="true" id="btnview"><i class="fa fa-shopping-cart"></i> Ver carrito
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  </button>
			</div>
                    </div>
		</div>
            </div>
        </form>
    </small>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../util/bootstrap/vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../util/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
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

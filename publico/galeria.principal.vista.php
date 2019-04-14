<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Producciones Nitro</title>

    <!-- Bootstrap core CSS -->
    <link href="../util/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Custom styles for this template -->
    <link href="../util/bootstrap/css/modern-business.css" rel="stylesheet" type="text/css"/>
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
            <li class="nav-item">
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

    <header>
      <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Galeria
        <small>Imagenes</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="publico.principal.vista.php">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Galeria 1</li>
      </ol>

      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="../imagenes/img/gallery/galeria1.jpg" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Imagen uno</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita laborum at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque eveniet unde.</p>
          <a class="btn btn-primary" href="#">Ver imagen
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Two -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="../imagenes/img/gallery/galeria2.JPG" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Imagen dos</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
          <a class="btn btn-primary" href="#">Ver imagen
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Three -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="../imagenes/img/gallery/galeria3.jpg" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Imagen tres</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, temporibus, dolores, at, praesentium ut unde repudiandae voluptatum sit ab debitis suscipit fugiat natus velit excepturi amet commodi deleniti alias possimus!</p>
          <a class="btn btn-primary" href="#">Ver imagen
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Four -->
      <div class="row">

        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="../imagenes/img/gallery/galeria4.jpg" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Imagen cuatro</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, quidem, consectetur, officia rem officiis illum aliquam perspiciatis aspernatur quod modi hic nemo qui soluta aut eius fugit quam in suscipit?</p>
          <a class="btn btn-primary" href="#">Ver imagen
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

    </div>
    <!-- /.container -->    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../util/bootstrap/vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../util/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  </body>

</html>
    <!--incluimos archivo que contiene el formulario de inicio de sesio-->
  
                    
    <script>
        function abrirIS(){//abre la ventana de dialogo
                $("#myModalIS").modal();
        };
    </script>
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
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('../imagenes/img/banner/banner-bg-2.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>PRODUCCIONES NITRO</h3>
              <p>Producciones Nitro es una empresa de restauración, 
                  con más de 7 años de experiencia, especializada en el servicio 
                  empresas y medios audiovisuales. También ofrecemos un servicio a 
                  particulares de Cocktails y de comidas (por encargo).</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('../imagenes/img/banner/banner-bg-3.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>PRODUCCIONES NITRO</h3>
              <p>Producciones Nitro es una empresa de restauración, 
                  con más de 7 años de experiencia, especializada en el servicio 
                  empresas y medios audiovisuales. También ofrecemos un servicio a 
                  particulares de Cocktails y de comidas (por encargo).</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('../imagenes/img/banner/banner-bg-1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>PRODUCCIONES NITRO</h3>
              <p>Producciones Nitro es una empresa de restauración, 
                  con más de 7 años de experiencia, especializada en el servicio 
                  empresas y medios audiovisuales. También ofrecemos un servicio a 
                  particulares de Cocktails y de comidas (por encargo).</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        <center> <p class="my-4">NOVEDAD, CALIDAD Y VARIEDAD SON LA BASE DE NUESTRO COMPROMISO CON NUESTROS CLIENTES.</p></center>
        <center> <h1 class="text-warning">NUESTRO COMPROMISO</h1></center>
<center> <h4 class="my-4">Nuestro compromiso fundamental es buscar día a día nuevos retos y lanzar al mercado productos innovadores.
Combinando, variedad de sabores y presentación, para ofrecer a nuestros clientes productos de la mejor calidad.
Siempre entusiastas de nuestro trabajo, nos esforzamos cada día por mejorar.</h4></center>


      <!-- Marketing Icons Section -->
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
              <h4 class="card text-white bg-secondary mb-3"><center class="text-warning" >EVENTOS</center></h4>
            <div class="card-body">
                <center>  <img src="../imagenes/img/iconos/iconfinder_Party_Newyears_Calender_2817129.png" alt=""/></center>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
              <h4 class="card text-white bg-secondary mb-3"><center class="text-warning">COMIDAS</center></h4>
            <div class="card-body">
                <center> <img src="../imagenes/img/service-icon/service-3.png" alt=""/></center>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
              <h4 class="card text-white bg-secondary mb-3"><center class="text-warning">CELEBRACIONES</center></h4>
            <div class="card-body">
                <center>     <img src="../imagenes/img/iconos/iconfinder_Party-Poppers_379424.png" alt=""/></center>
            </div>
            <div class="card-footer">
  
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Portfolio Section -->
      <center> <p class="my-4"> EFICIENTE, PROFESIONAL Y PERSONALIZADO SON LA BASE DE NUESTRO SERVICIO.</p></center>
      <center><h2 class="text-warning" >SERVICIOS</h2></center>

      <div class="row">
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/Enventos-700x400.jpg" alt=""/>
            <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Eventos y Celebraciones</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/Fiesta-temática-para-niños.jpg" alt=""/>
            <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Menús para niños</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/50-best-cocktails-inside.jpg" alt=""/>
            <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Cocktail</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/7a3cc23503dfcdd8760908114ff1205f_630x315.jpg" alt=""/>
            <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Brunch</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/coffee-break-3.jpg" alt=""/>
              <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Coffee Break</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <img src="../imagenes/img/iconos/eventos-grande.jpg" alt=""/>
            <div class="card-body">
              <h4 class="card-title">
                <a class="text-warning" href="#">Todo tipo de Evento</a>
              </h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6">
          <h2>Modern Business Features</h2>
          <p>The Modern Business template by Start Bootstrap includes:</p>
          <ul>
            <li>
              <strong>Bootstrap v4</strong>
            </li>
            <li>jQuery</li>
            <li>Font Awesome</li>
            <li>Working contact form with validation</li>
            <li>Unstyled page elements for easy customization</li>
          </ul>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="../imagenes/img/banner/catering.jpg" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
        </div>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
        </div>
      </div>

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
  </body>

</html>
    <!--incluimos archivo que contiene el formulario de inicio de sesio-->
  
                    
    <script>
        function abrirIS(){//abre la ventana de dialogo
                $("#myModalIS").modal();
        };
    </script>

    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-dark" role="navigation">
      <div class="container">
    <a href="#"><img src="../imagenes/img/logo-1.png" height="50px"> <span class="navbar-brand align-bottom pb-2"></span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
          <ul class="navbar-nav ml-auto navbar-right">
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
                <a class="nav-link" href="publico.contacto.vista.php">Contacto</a>

            </li>
            <li class="nav-item dropdown">
               <a href="../publico/carrito.vista.php" class="btn btn-success btn-info">
                    <span class="glyphicon glyphicon-shopping-cart"> </span>
                </a>

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


    
    <!--incluimos archivo que contiene el formulario de inicio de sesio-->
    <?php
        include_once '../publico/iniciar.sesion.vista.php';
    ?>
                    
    <script>
        function abrirIS(){//abre la ventana de dialogo
                $("#myModalIS").modal();
        };
    </script>
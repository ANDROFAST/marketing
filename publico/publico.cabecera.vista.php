    
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../publico/publico.principal.vista.php">Catálogo</a>
            </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                           
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
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
                <button type="submit" class="btn btn-default">Submit</button>&nbsp;&nbsp;
                <a href="../publico/carrito.vista.php" class="btn btn-success btn-info">
                    <span class="glyphicon glyphicon-shopping-cart"> </span>
                </a>
            </form>
            
            <?php
                require_once '../publico/sesion.cliente.validar.vista.php';
                require_once '../util/funciones/estadoSesion.php';
                
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
            
        </div><!-- /.navbar-collapse --><!--/.nav-collapse -->
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
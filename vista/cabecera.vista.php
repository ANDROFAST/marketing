<header class="main-header">               
<nav class="navbar navbar-static-top">
  <div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
      <i class="fa fa-bars"></i>
    </button>
  </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav">
        
        <?php
        require_once './sesion.validar.vista.php';
            if($cargoUsuario=='ADMINISTRADOR' || $cargoUsuario=='JEFE DE SISTEMAS'){
                echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-edit"></i>&nbsp;Mantenimientos <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="articulo.vista.php">Artículos</a></li>
                            <li><a href="tipoarticulos.vista.php">Tipos de Articulos</a></li>
                            <li><a href="categoria.vista.php">Categorías</a></li>
                            <li class="divider"></li>
                            <li><a href="cliente.vista.php">Cliente</a></li> 
                            <li><a href="tipocliente.vista.php">Tipos de Clientes</a></li> 
                            <li class="divider"></li>
                            <li><a href="evento.vista.php">Tipo de Eventos</a></li>
                            <li><a href="preguntas.vista.php">Preguntas</a></li>
                            <li><a href="respuesta.vista.php">Respuesta</a></li>  
                            <li class="divider"></li>
                            <li><a href="personal.vista.php">Personal</a></li>  
                            <li><a href="cargo.vista.php">Cargo</a></li>              
                            <li><a href="area.vista.php">Área</a></li>  
                      <!--      <li class="divider"></li>
                            <li><a href="tipo.comprobante.vista.php">Tipo Comprobante</a></li> -->
                          <li class="divider"></li>
                          <li><a href="departamento.vista.php">Departamento</a></li>  
                          <li><a href="provincia.vista.php">Provincia</a></li>              
                          <li><a href="distrito.vista.php">Distrito</a></li>  

                          <li class="divider"></li>
                          <li><a href="tipo.mensaje.vista.php">Tipo de Mensajes</a></li>  
                        </ul>
                      </li>';
            }else{
                
            }
        ?>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-laptop"></i>&nbsp;Transacciones <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="venta.listado.vista.php">Registro de Ventas</a></li>
            <li><a href="pedido.listado.vista.php">Registro de Pedidos</a></li>            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-book"></i>&nbsp;Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">              
            
            <li><a href="reporte.cliente.php">Reporte de Pedidos por Clientes</a></li>
            <li class="divider"></li>
            <li><a href="reporte.pedido.php">Reporte de Productos por Ventas</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bar-chart-o"></i>&nbsp;Marketing <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="ranking.articulos.vista.php">Ranking de artículos más vendidos por cliente </a></li>
              <!--<li><a href="mensaje.listado.vista.php">Enviar mensaje</a></li>
            <li class="divider"></li>
            <li><a href="encuesta.vista.php">Encuesta</a></li>-->
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gears"></i>&nbsp;Administración <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="cargo.vista.php">Grupos de usuarios</a></li>
            <li><a href="usuario.vista.php">Usuarios</a></li>
            <li class="divider"></li>
            <li><a href="#">Permisos</a></li>
          </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">      
        
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../imagenes/<?php echo $fotoUsuario; ?>" class="user-image" alt="User Image"/>
          <span class="hidden-xs"><?php echo $nombreUsuario; ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <!--<img src="../imagenes/1.png" class="img-circle" alt="User Image" />-->
            <img src="../imagenes/<?php echo $fotoUsuario; ?>" class="img-circle" alt="User Image" />
            <p>
              <?php echo $nombreUsuario; ?>
              <br>
              <small><?php echo $cargoUsuario; ?></small>
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Cambiar Contraseña</a>
            </div>
            <div class="pull-right">
                <a href="../controlador/sesion.cerrar.controlador.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Salir</a>
            </div>
          </li>
        </ul>
      </li>          
    </ul>
  </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
</header>





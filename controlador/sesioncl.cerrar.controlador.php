<?php

    session_name("loginUsuarioCliente");
    session_start();
    
    unset($_SESSION["nombre_usuario"]);
    unset($_SESSION["scl_nombre_usuario"]);
    unset($_SESSION["scl_codigo_usuario"]);
    
    session_destroy();//destruye sesion y redirige a la pagina principal del publico
    
    header("location:../publico/publico.principal.vista.php");
<?php

session_name("loginUsuarioCliente");
session_start();

if (! isset( $_SESSION["scl_nombre_usuario"] ) ){
    //Esto se cumple cuando el usuario no ha iniciado sesión
    $GLOBALS['isLogin'] = 0;
    //header("location:../vista/publico.principal.vista.php");
    //exit;
}else{
    $GLOBALS['isLogin'] = 1;
    $codigo_cliente_usuario = $_SESSION["scl_codigo_usuario_cliente"];
}

//Capturando los datos del usuario que ha iniciado sesión
/*$nombreUsuario = ucwords( strtolower($_SESSION["scl_nombre_usuario"]) );

$codigoUsuario = $_SESSION["scl_codigo_usuario"];

if (file_exists("../imagenes/".$codigoUsuario . ".png" )){
    $fotoUsuario = $codigoUsuario . ".png";
}else{
    $fotoUsuario = "sin-foto.jpg";
}*/


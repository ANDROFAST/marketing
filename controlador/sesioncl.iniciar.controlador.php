<?php
/*sesion del cliente*/
require_once '../negocio/SesionCliente.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once '../util/funciones/estadoSesion.php';

try {
    $email = $_POST["usrname"];
    $clave = $_POST["psw"];
    
    if ( isset(  $_POST["chkrecordar"]  )  ) {
        $recordar = $_POST["chkrecordar"];
    }else{
        $recordar = "N";
    }
    
    $objSesion = new SesionCliente();
    $objSesion->setEmail($email);
    $objSesion->setClave($clave);
    $objSesion->setRecordarUsuario($recordar);
    
    $resultado = $objSesion->iniciarSesioncl();
    echo $resultado;
            
   
    switch ($resultado) {
        case 0: //Usuario inactivo, no puede ingresar
            Funciones::mensaje("El usuario esta inactivo", "a", "../vista/index.php", 5);
            break;

        case 1: //Usuario activo, si puede ingresar
            //Funciones::mensaje("El usuario autenticado correctamente", "a", 5);
            $GLOBALS['isLogin'] = 1;
            header("location:../publico/cliente.principal.vista.php");
            break;
        
        default:
            $GLOBALS['isLogin'] = 0;
            Funciones::mensaje("El usuario o la contraseña son incorrectos", "e", "../vista/index.php", 5);
            break;
    }
    
   
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}


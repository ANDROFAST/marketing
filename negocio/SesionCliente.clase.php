<?php
require_once '../util/funciones/estadoSesion.php';
require '../datos/Conexion.clase.php';

class SesionCliente extends Conexion {
    private $email;
    private $clave;
    private $recordarUsuario;
    
    function getEmail() {
        return $this->email;
    }

    function getClave() {
        return $this->clave;
    }

    function getRecordarUsuario() {
        return $this->recordarUsuario;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setRecordarUsuario($recordarUsuario) {
        $this->recordarUsuario = $recordarUsuario;
    }

    public function iniciarSesion() {
        try {
            $sql = "
                 select
                        cl.apellido_paterno,
                        cl.apellido_materno,
                        cl.nombres,
                        cl.codigo_cliente,
                        ucl.clave,
                        ucl.estado,
                        ucl.codigo_usuario
                from
                        cliente cl
                        inner join usuario_cliente ucl on ( cl.codigo_cliente = ucl.codigo_cliente )
                where
                        cl.email = :p_email
                ";
            
            
            //Creamos una sentencia
            $sentencia = $this->dblink->prepare($sql);
            
            //Vincular el parametro1 p_email con el valor del atribito usuario;
            $sentencia->bindParam(":p_email", $this->getEmail());
            
            //ejecutar la sentencia
            $sentencia->execute();
            
            //Capturar el resultado que devuelve la sentencia
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            if ($resultado["clave"] ===  md5( $this->getClave() ) ){

                if ($resultado["estado"] === "I"){
                    //Usuario inactivo, NO puede ingresar a la app
                    return 0;
                }else{
                    //Usuario activo, Si puede ingresar a la app
                    //$GLOBALS['isLogin'] = 1;
                    session_name("loginUsuarioCliente");//nombre de la sesion del cliente
                    session_start();
                    
                    $_SESSION["nombre_usuario"] = $resultado["nombres"];
                    $_SESSION["scl_nombre_usuario"] = $resultado["apellido_paterno"]." ".$resultado["apellido_materno"].", ".$resultado["nombres"];
                    $_SESSION["scl_codigo_usuario"] = $resultado["codigo_usuario"];
                    $_SESSION["scl_codigo_usuario_cliente"] = $resultado["codigo_cliente"];
                    
                    if ($this->getRecordarUsuario()=="S"){
                        //El usuario ha marcado el Check
                        setcookie("loginusuariocl", $this->getEmail(), 0, "/");
                    }else{
                        setcookie("loginusuariocl", "", 0, "/");
                    }
                    
                    return 1;                   
                }               
            }else{
                //La clave ingresada por el usuario es diferente a la que esta grabada en la BD
                   return 2;
            }       
          
        } catch (Exception $exc) {
            throw $exc;
        }
          
    } 
    
    public function iniciarSesioncl() {
        try {
            $sql = "
                 select
                        cl.apellido_paterno,
                        cl.apellido_materno,
                        cl.nombres,
                        cl.razon_social,
                        cl.clave,
                        cl.estado,
                        cl.codigo_cliente
                from
                        cliente cl
                where
                        cl.email = :p_email
                ";
            
            
            //Creamos una sentencia
            $sentencia = $this->dblink->prepare($sql);
            
            //Vincular el parametro1 p_email con el valor del atribito usuario;
            $sentencia->bindParam(":p_email", $this->getEmail());
            
            //ejecutar la sentencia
            $sentencia->execute();
            
            //Capturar el resultado que devuelve la sentencia
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            if ($resultado["clave"] ===  md5( $this->getClave() ) ){

                if ($resultado["estado"] === "I"){
                    //Usuario inactivo, NO puede ingresar a la app
                    return 0;
                }else{
                    //Usuario activo, Si puede ingresar a la app
                    //$GLOBALS['isLogin'] = 1;
                    session_name("loginUsuarioCliente");//nombre de la sesion del cliente
                    session_start();
                    if($resultado["razon_social"]=='')
                    {
                        $_SESSION["nombre_usuario"] = $resultado["nombres"];
                        $_SESSION["scl_nombre_usuario"] = $resultado["apellido_paterno"]." ".$resultado["apellido_materno"].", ".$resultado["nombres"];
                        $_SESSION["scl_codigo_usuario"] = $resultado["codigo_cliente"];
                        $_SESSION["scl_codigo_usuario_cliente"] = $resultado["codigo_cliente"];
                    }else
                    {
                        $_SESSION["nombre_usuario"] = $resultado["razon_social"];
                        $_SESSION["scl_nombre_usuario"] = $resultado["razon_social"];
                        $_SESSION["scl_codigo_usuario"] = $resultado["codigo_cliente"];
                        $_SESSION["scl_codigo_usuario_cliente"] = $resultado["codigo_cliente"];
                    }
                    
                    
                    if ($this->getRecordarUsuario()=="S"){
                        //El usuario ha marcado el Check
                        setcookie("loginusuariocl", $this->getEmail(), 0, "/");
                    }else{
                        setcookie("loginusuariocl", "", 0, "/");
                    }
                    
                    return 1;                   
                }               
            }else{
                //La clave ingresada por el usuario es diferente a la que esta grabada en la BD
                   return 2;
            }       
          
        } catch (Exception $exc) {
            throw $exc;
        }
          
    } 
}
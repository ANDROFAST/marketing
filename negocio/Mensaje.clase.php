<?php 
require_once '../datos/Conexion.clase.php';
class Mensaje extends Conexion {
    private $codigoMensaje;
    private $tipoMensaje;
    private $mensaje;
    private $codigoMDetalle;

    private $detalleMensaje;//JSON
    public function getCodigoMensaje()
    {
        return $this->codigoMensaje;
    }
    
    public function setCodigoMensaje($codigoMensaje)
    {
        $this->codigoMensaje = $codigoMensaje;
        return $this;
    }
    public function getTipoMensaje()
    {
        return $this->tipoMensaje;
    }
    
    public function setTipoMensaje($tipoMensaje)
    {
        $this->tipoMensaje = $tipoMensaje;
        return $this;
    }
    public function getMensaje()
    {
        return $this->mensaje;
    }
    
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
        return $this;
    }

    public function getDetalleMensaje()
    {
        return $this->detalleMensaje;
    }
    
    public function setDetalleMensaje($detalleMensaje)
    {
        $this->detalleMensaje = $detalleMensaje;
        return $this;
    }

    
    public function getCodigoMDetalle()
    {
        return $this->codigoMDetalle;
    }
    
    public function setCodigoMDetalle($codigoMDetalle)
    {
        $this->codigoMDetalle = $codigoMDetalle;
        return $this;
    }
        public function cargarListaDatos() {
    try {
            $sql = "select codigo_mensaje,tipo_mensaje from mensaje order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

     public function listar($fecha1, $fecha2, $tipo){
    try {
            $sql = "select * from f_listar_mensajes(:p_f1, :p_f2, :p_tipo);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_f1", $fecha1);
            $sentencia->bindParam(":p_f2", $fecha2);
            $sentencia->bindParam(":p_tipo", $tipo);
            
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }

        public function listarTipoMensaje() {
    try {
            $sql = "select *from mensaje ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


     public function eliminarMensaje( $p_codigoMensaje ){
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from mensaje where codigo_mensaje = :p_codigoMensaje";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoMensaje", $p_codigoMensaje);
            $sentencia->execute();
            
            $this->dblink->commit();
            
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

     public function agregarMensaje() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('mensaje') as m";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["m"];
                $this->setCodigoMensaje($nuevoCodigo);
                
                $sql = "
                        INSERT INTO mensaje(
                                codigo_mensaje, 
                                tipo_mensaje,
                                 mensaje)
                        VALUES (:p_codigo_mensaje, 
                                :p_tipo_mensaje,
                                :p_mensaje);
                    ";
                
                //Preparar la sentencia
                $sentencia = $this->dblink->prepare($sql);
                
                //Asignar un valor a cada parametro
                $sentencia->bindParam(":p_codigo_mensaje", $this->getCodigoMensaje());
                $sentencia->bindParam(":p_tipo_mensaje", $this->getTipoMensaje());
                $sentencia->bindParam(":p_mensaje", $this->getMensaje());
                
                //Ejecutar la sentencia preparada
                $sentencia->execute();
                
                
                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'mensaje'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                
                return true; //significa que todo se ha ejecutado correctamente
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla mensaje");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack(); //Extornar toda la transacción
            throw $exc;
        }
        
        return false;       
    }

        public function cargarMensajeEvento($p_eventomensaje){
        try{
            $sql = "select mensaje from mensaje where codigo_mensaje=:p_eventomensaje";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_eventomensaje", $p_eventomensaje);
            $sentencia->execute();
            
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);            
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }       
    }
            public function editarMensaje() {
        $this->dblink->beginTransaction();
        
        try {
           $sql = " 
                 update mensaje set
                        tipo_mensaje       = :p_tipo_mensaje,
                        mensaje            =:p_mensaje
                 where
                        codigo_mensaje     = :p_codigo_mensaje
               ";
   
           //Preparar la sentencia
            $sentencia = $this->dblink->prepare($sql);

            //Asignar un valor a cada parametro
            $sentencia->bindParam(":p_tipo_mensaje", $this->getTipoMensaje());
            $sentencia->bindParam(":p_mensaje", $this->getMensaje());
            $sentencia->bindParam(":p_codigo_mensaje", $this->getCodigoMensaje());

            //Ejecutar la sentencia preparada
            $sentencia->execute();
            
            
            $this->dblink->commit();
                
            return true;
            
        } catch (Exception $exc) {
           $this->dblink->rollBack();
           throw $exc;
        }
        
        return false;
            
    }

        public function leerDatos($p_codigo_mensaje) {
        try {
            $sql = "
                      select
                            m.*
                    from
                            mensaje m 
                    where
                            m.codigo_mensaje= :p_codigo_mensaje
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_mensaje", $p_codigo_mensaje);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }



    public function agregar() {
        
        $detalleVentaArray = json_decode($this->getDetalleMensaje());//convertir formato json a array
        $this->dblink->beginTransaction();
         try {  
       
            $sql = "select * from f_generar_correlativo('mensaje_detalle') as m";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoNroVenta = $resultado["m"];
                $this->setCodigoMDetalle($nuevoNroVenta);
         
              foreach( $detalleVentaArray as $key => $value ){
                    $sql = " 
                            INSERT INTO mensaje_detalle(
                                codigo_mensaje_detalle, 
                                fecha_mensaje_detalle, 
                                codigo_cliente, 
                                codigo_mensaje
                                )
                            VALUES (:p_codigo_mensaje_detalle, 
                                    :p_fecha_mensaje_detalle, 
                                    :p_codigo_cliente,
                                    :p_codigo_mensaje);";
                    $sentencia =  $this->dblink->prepare($sql);
                    
                   // $item++;
                    
                    $sentencia->bindParam(":p_codigo_mensaje_detalle", $this->getCodigoMDetalle());
                    $sentencia->bindParam(":p_fecha_mensaje_detalle", $value->fecha);
                    $sentencia->bindParam(":p_codigo_cliente", $value->codigoCliente);//obtenemos el valor(value) del detalleVentaArray
                    $sentencia->bindParam(":p_codigo_mensaje", $value->Codmensaje);
                    
                $sentencia->execute();
                                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'mensaje_detalle'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                }
               $this->dblink->commit();
                
                return true; //significa que todo se ha ejecutado correctamente
    
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla tipo");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack(); //Extornar toda la transacción
            throw $exc;
        }
        
        return false;       
    }
}
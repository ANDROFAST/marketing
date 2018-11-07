<?php

require_once '../datos/Conexion.clase.php';

class Pedido extends Conexion{
    private $nroPedido;    
    private $codigoCliente;
    private $total;
    private $fechaRegistro;    
    private $codigoUsuario;
    private $direccionEvento;
    private $fechaEvento;
    private $codigoTipoEvento;
    private $estado;
    private $dirigidoa;
    
     private $detallePedido;//JSON
    function getNroPedido() {
        return $this->nroPedido;
    }

    function getCodigoCliente() {
        return $this->codigoCliente;
    }

    function getTotal() {
        return $this->total;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getCodigoUsuario() {
        return $this->codigoUsuario;
    }

    function getDireccionEvento() {
        return $this->direccionEvento;
    }

    function getFechaEvento() {
        return $this->fechaEvento;
    }

    function getCodigoTipoEvento() {
        return $this->codigoTipoEvento;
    }

    function getEstado() {
        return $this->estado;
    }

    function setNroPedido($nroPedido) {
        $this->nroPedido = $nroPedido;
    }

    function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setCodigoUsuario($codigoUsuario) {
        $this->codigoUsuario = $codigoUsuario;
    }

    function setDireccionEvento($direccionEvento) {
        $this->direccionEvento = $direccionEvento;
    }

    function setFechaEvento($fechaEvento) {
        $this->fechaEvento = $fechaEvento;
    }

    function setCodigoTipoEvento($codigoTipoEvento) {
        $this->codigoTipoEvento = $codigoTipoEvento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function getDetallePedido() {
        return $this->detallePedido;
    }

    function setDetallePedido($detallePedido) {
        $this->detallePedido = $detallePedido;
    }
    
    function getDirigidoa() {
        return $this->dirigidoa;
    }

    function setDirigidoa($dirigidoa) {
        $this->dirigidoa = $dirigidoa;
    }

    
        
    public function listar($fecha1, $fecha2, $tipo){
        
        try {
            $sql = "select * from f_listar_pedido(:p_f1, :p_f2, :p_tipo);";
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
    
     public function anular($numeroPedido) {
        $this->dblink->beginTransaction();
        try {
            $sql = "update venta set estado = 'A' where numero_pedido = :p_numero_pedido";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_numero_pedido", $numeroPedido);
            $sentencia->execute();
            
            //Terminar la transacción
            $this->dblink->commit();
            
            return true;
                    
        } catch (Exception $exc) {
            $this->dblink->rollBack(); //Extornar toda la transacción
            throw $exc;
        }
    }
    
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('pedido') as np";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoNroPed = $resultado["np"];
                $this->setNroPedido($nuevoNroPed);
                
                $sql = "INSERT INTO pedido(
                                numero_pedido,                                 
                                codigo_cliente, 
                                total, 
                                fecha_registro,
                                codigo_usuario,
                                direccion_evento,
                                fecha_evento,
                                codigo_tipo_evento,dirigidoa
                                )
                        VALUES (:p_numero_pedido,                                 
                                :p_codigo_cliente,                                 
                                :p_total, 
                                :p_fecha_registro, 
                                :p_codigo_usuario,
                                :p_direccion_evento,
                                :p_fecha_evento,
                                :p_codigo_tipo_evento,
                                :p_dirigidoa);";
                
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_numero_pedido", $this->getNroPedido());;
                $sentencia->bindParam(":p_codigo_cliente", $this->getCodigoCliente());
                $sentencia->bindParam(":p_total", $this->getTotal());
                $sentencia->bindParam(":p_fecha_registro", $this->getFechaRegistro());
                $sentencia->bindParam(":p_codigo_usuario", $this->getCodigoUsuario());
                $sentencia->bindParam(":p_direccion_evento", $this->getDireccionEvento());
                $sentencia->bindParam(":p_fecha_evento", $this->getFechaEvento());
                $sentencia->bindParam(":p_codigo_tipo_evento", $this->getCodigoTipoEvento());
                $sentencia->bindParam(":p_dirigidoa", $this->getDirigidoa());
                
                $sentencia->execute();
                
                /*Insertar en la clase detalle de venta*/
                $detallePedidoArray = json_decode($this->getDetallePedido());//convertir formato json a array
                
                $item = 0;
                
                foreach( $detallePedidoArray as $key => $value ){
                    $sql = " 
                            INSERT INTO pedido_detalle(
                                numero_pedido, 
                                item, 
                                codigo_articulo, 
                                cantidad, 
                                precio, 
                                descuento,
                                importe
                                )
                            VALUES (:p_numero_pedido, 
                                    :p_item, 
                                    :p_codigo_articulo,
                                    :p_cantidad, 
                                    :p_precio, 
                                    :p_descuento,                                     
                                    :p_importe);";
                    $sentencia =  $this->dblink->prepare($sql);
                    
                    //$item++;
                    
                    $sentencia->bindParam(":p_numero_pedido", $this->getNroPedido());
                    $sentencia->bindParam(":p_item", $value->item);
                    $sentencia->bindParam(":p_codigo_articulo", $value->codigoArticulo);//obtenemos el valor(value) del detalleVentaArray
                    $sentencia->bindParam(":p_cantidad", $value->cantidad);
                    $sentencia->bindParam(":p_precio", $value->precioArticulo);                                        
                    $sentencia->bindParam(":p_descuento", $value->descuento);                    
                    $sentencia->bindParam(":p_importe", $value->importe);
                    
                    $sentencia->execute();

                }
                
                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'pedido'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla pedido");
            }
                      
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function reportePedido($fecha1, $fecha2, $tipo, $top, $tevento) {
        $sql = "select * from f_reporte_venta_clientes_productos (:p_fecha1, :p_fecha2, :p_tipo, :p_top, :p_tevento)";
        $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->bindParam(":p_tipo", $tipo);
            $sentencia->bindParam(":p_top", $top);
            $sentencia->bindParam(":p_tevento", $tevento);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
        return $resultado;
    }

}

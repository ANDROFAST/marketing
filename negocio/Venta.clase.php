<?php

require_once '../datos/Conexion.clase.php';

class Venta extends Conexion{
    
    private $nroVenta;
    private $codigoTipoComprobante;
    private $nroSerie;
    private $nroDocumento;
    private $codigoCliente;
    private $fechaVenta;
    private $porcentajeIGV;
    private $subTotal;
    private $igv;
    private $total;
    private $codigoUsuario;
    private $fechaEvento;
    private $codigoTipoEvento;
    
    private $direccionEvento;
    
    private $detalleVenta;//JSON
    
    function getDireccionEvento() {
        return $this->direccionEvento;
    }

    function setDireccionEvento($direccionEvento) {
        $this->direccionEvento = $direccionEvento;
    }

    public function getNroVenta() {
        return $this->nroVenta;
    }

    public function getCodigoTipoComprobante() {
        return $this->codigoTipoComprobante;
    }

    public function getNroSerie() {
        return $this->nroSerie;
    }

    public function getNroDocumento() {
        return $this->nroDocumento;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function getFechaVenta() {
        return $this->fechaVenta;
    }

    public function getPorcentajeIGV() {
        return $this->porcentajeIGV;
    }

    public function getSubTotal() {
        return $this->subTotal;
    }

    public function getIgv() {
        return $this->igv;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getCodigoUsuario() {
        return $this->codigoUsuario;
    }

    public function getDetalleVenta() {
        return $this->detalleVenta;
    }

    public function setNroVenta($nroVenta) {
        $this->nroVenta = $nroVenta;
    }

    public function setCodigoTipoComprobante($codigoTipoComprobante) {
        $this->codigoTipoComprobante = $codigoTipoComprobante;
    }

    public function setNroSerie($nroSerie) {
        $this->nroSerie = $nroSerie;
    }

    public function setNroDocumento($nroDocumento) {
        $this->nroDocumento = $nroDocumento;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    public function setFechaVenta($fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    public function setPorcentajeIGV($porcentajeIGV) {
        $this->porcentajeIGV = $porcentajeIGV;
    }

    public function setSubTotal($subTotal) {
        $this->subTotal = $subTotal;
    }

    public function setIgv($igv) {
        $this->igv = $igv;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setCodigoUsuario($codigoUsuario) {
        $this->codigoUsuario = $codigoUsuario;
    }

    public function setDetalleVenta($detalleVenta) {
        $this->detalleVenta = $detalleVenta;
    }
    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }
    
    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;
        return $this;
    }

    public function getCodigoTipoEvento()
    {
        return $this->codigoTipoEvento;
    }
    
    public function setCodigoTipoEvento($codigoTipoEvento)
    {
        $this->codigoTipoEvento = $codigoTipoEvento;
        return $this;
    }
    

    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('venta') as nv";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoNroVenta = $resultado["nv"];
                $this->setNroVenta($nuevoNroVenta);
                
                $sql = "INSERT INTO venta(
                                numero_venta, 
                                codigo_tipo_comprobante, 
                                numero_serie, 
                                numero_documento, 
                                codigo_cliente, 
                                fecha_venta, 
                                porcentaje_igv, 
                                sub_total, 
                                igv, 
                                total, 
                                codigo_usuario,
                                fecha_evento,
                                direccion_evento,
                                codigo_tipo_evento
                                )
                        VALUES (:p_numero_venta, 
                                :p_codigo_tipo_comprobante, 
                                :p_numero_serie, 
                                :p_numero_documento, 
                                :p_codigo_cliente, 
                                :p_fecha_venta, 
                                :p_porcentaje_igv, 
                                :p_sub_total, 
                                :p_igv, 
                                :p_total, 
                                :p_codigo_usuario,
                                :p_fecha_evento,
                                :p_direccion_evento,
                                :p_codigo_tipo_evento);";
                
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_numero_venta", $this->getNroVenta());
                $sentencia->bindParam(":p_codigo_tipo_comprobante", $this->getCodigoTipoComprobante());
                $sentencia->bindParam(":p_numero_serie", $this->getNroSerie());
                $sentencia->bindParam(":p_numero_documento", $this->getNroDocumento());
                $sentencia->bindParam(":p_codigo_cliente", $this->getCodigoCliente());
                $sentencia->bindParam(":p_fecha_venta", $this->getFechaVenta());
                $sentencia->bindParam(":p_porcentaje_igv", $this->getPorcentajeIGV());
                $sentencia->bindParam(":p_sub_total", $this->getSubTotal());
                $sentencia->bindParam(":p_igv", $this->getIgv());
                $sentencia->bindParam(":p_total", $this->getTotal());
                $sentencia->bindParam(":p_codigo_usuario", $this->getCodigoUsuario());
                $sentencia->bindParam(":p_fecha_evento", $this->getFechaEvento());
                $sentencia->bindParam(":p_direccion_evento", $this->getDireccionEvento());
                $sentencia->bindParam(":p_codigo_tipo_evento", $this->getCodigoTipoEvento());
                
                $sentencia->execute();
                
                /*Insertar en la clase detalle de venta*/
                $detalleVentaArray = json_decode($this->getDetalleVenta());//convertir formato json a array
                
                $item = 0;
                
                foreach( $detalleVentaArray as $key => $value ){
                    $sql = " 
                            INSERT INTO venta_detalle(
                                numero_venta, 
                                item, 
                                codigo_articulo, 
                                cantidad, 
                                precio, 
                                descuento, 
                                importe
                                )
                            VALUES (:p_numero_venta, 
                                    :p_item, 
                                    :p_codigo_articulo,
                                    :p_cantidad, 
                                    :p_precio, 
                                    :p_descuento, 
                                    :p_importe);";
                    $sentencia =  $this->dblink->prepare($sql);
                    
                    //$item++;
                    
                    $sentencia->bindParam(":p_numero_venta", $this->getNroVenta());
                    $sentencia->bindParam(":p_item", $value->item);
                    $sentencia->bindParam(":p_codigo_articulo", $value->codigoArticulo);//obtenemos el valor(value) del detalleVentaArray
                    $sentencia->bindParam(":p_cantidad", $value->cantidad);
                    $sentencia->bindParam(":p_precio", $value->precioArticulo);
                    
                    $descuento = 0;                    
                    
                    $sentencia->bindParam(":p_descuento", $descuento);                    
                    $sentencia->bindParam(":p_importe", $value->importe);
                    
                    $sentencia->execute();

                }
                
                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'venta'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla venta");
            }
                      
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }
    
    public function listarVentasPorClienteRanking($codigocliente){
        
        try {
            $sql = "select v.numero_venta,vd.item,vd.codigo_articulo, a.nombre as articulo_rank
                    from venta v inner join venta_detalle vd on v.numero_venta=vd.numero_venta
                        inner join articulo a on vd.codigo_articulo=a.codigo_articulo
                    where v.estado= 'E' and v.codigo_cliente= :p_codigo_cliente";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cliente", $codigocliente);            
            $sentencia->execute();            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listar($fecha1, $fecha2, $tipo){
        
        try {
            $sql = "select * from f_listar_venta(:p_f1, :p_f2, :p_tipo);";
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
    public function listarPedidosCliente($codigocliente){
        
        try {
            $sql = "
                SELECT 
	  pedido.numero_pedido,
	  pedido.fecha_registro, 
	  pedido.fecha_evento, 
	  concat(cliente.apellido_paterno, ' ',cliente.apellido_materno, ' ',cliente.nombres) as cliente,	  
	  pedido.total, 	  
	  pedido.direccion_evento,
	  tipo_evento.descripcion as tipevento,
	  (case 
		when pedido.estado = 'P' then 'Pendiente'
		when pedido.estado = 'T' then 'Atendido'
		when pedido.estado = 'F' then 'Finalizado'
		else 'Anulado' end) as estado,
	  concat(personal.apellido_paterno, ' ', personal.apellido_materno, ' ', personal.nombres) as usuario            
	FROM 
	  public.pedido, 
	  public.cliente, 
	  public.usuario, 
	  public.personal,
	  public.tipo_evento
	WHERE 
	  cliente.codigo_cliente = pedido.codigo_cliente AND
	  usuario.codigo_usuario = pedido.codigo_usuario AND
	  tipo_evento.codigo_tipo_evento = pedido.codigo_tipo_evento AND
	  personal.dni = usuario.dni_usuario  and pedido.codigo_cliente= :p_codigo_cliente
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cliente", $codigocliente);
            
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function consultaDetallePedido($numeropedido){
        
        try {
            $sql = "
                select pd.*, a.nombre as nombre_articulo, p.direccion_evento, p.fecha_evento, te.descripcion as tipo_evento, te.codigo_tipo_evento
                from pedido_detalle pd inner join articulo a on pd.codigo_articulo=a.codigo_articulo
				inner join pedido p on p.numero_pedido=pd.numero_pedido
				inner join tipo_evento te on p.codigo_tipo_evento=te.codigo_tipo_evento
                where p.numero_pedido= :p_numero_pedido
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_numero_pedido", $numeropedido);
            
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function consultaRankingArticulosCompraCliente($codigocliente){
        
        try {
            $sql = "
                
                   select a.codigo_articulo,a.nombre as articulo,count(vd.codigo_articulo )as frecuencia_compra,
                                                sum(vd.cantidad) as cantidad,
					(			
					    select count(*) from venta v1
					    where v1.estado= 'E' and v1.codigo_cliente= :p_codigo_cliente
					) as cantidaddetransacciones,
					( cast( 
					  cast( count(vd.codigo_articulo ) as decimal(4,2)) / 
					  cast((			
					    select count(*) from venta v1
					    where v1.estado= 'E' and v1.codigo_cliente= :p_codigo_cliente
					  ) as decimal(4,2))
					 as decimal(4,2)) * 100 ) as porcentaje 
                    from venta v inner join venta_detalle vd on v.numero_venta=vd.numero_venta
                                 inner join articulo a on a.codigo_articulo=vd.codigo_articulo
                    where v.estado= 'E' and v.codigo_cliente= :p_codigo_cliente
                    group by 1
                    order by 2 desc
                ";
            
            /*
             
              select a.nombre as articulo,count(vd.codigo_articulo )as frecuencia_compra,
                                                sum(vd.cantidad) as cantidad
                    from venta v inner join venta_detalle vd on v.numero_venta=vd.numero_venta
                                 inner join articulo a on a.codigo_articulo=vd.codigo_articulo
                    where v.estado= 'E' and v.codigo_cliente= :p_codigo_cliente
                    group by 1
                    order by 3 desc
              
              
                    select a.nombre as articulo,count(vd.codigo_articulo )as frecuencia_compra,
                                                sum(vd.cantidad) as cantidad,
					(			
					    select count(*) from venta v1
					    where v1.estado= 'E' and v1.codigo_cliente= :p_codigo_cliente
					) as cantidaddetransacciones,
					( cast( 
					  cast( count(vd.codigo_articulo ) as decimal(4,2)) / 
					  cast((			
					    select count(*) from venta v1
					    where v1.estado= 'E' and v1.codigo_cliente= :p_codigo_cliente
					  ) as decimal(4,2))
					 as decimal(4,2)) * 100 ) as porcentaje 
                    from venta v inner join venta_detalle vd on v.numero_venta=vd.numero_venta
                                 inner join articulo a on a.codigo_articulo=vd.codigo_articulo
                    where v.estado= 'E' and v.codigo_cliente= :p_codigo_cliente
                    group by 1
                    order by 3 desc
             
             */
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cliente", $codigocliente);
            
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function anular($numeroVenta) {
        $this->dblink->beginTransaction();
        try {
            $sql = "update venta set estado = 'A' where numero_venta = :p_numero_venta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_numero_venta", $numeroVenta);
            $sentencia->execute();
            
            $sql = "select codigo_articulo, cantidad from venta_detalle where numero_venta = :p_numero_venta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_numero_venta", $numeroVenta);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            for ($i = 0; $i < count($resultado); $i++) {
                $sql = "update articulo set stock = stock + :p_cantidad where codigo_articulo = :p_codigo_articulo";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cantidad", $resultado[$i]["cantidad"]);
                $sentencia->bindParam(":p_codigo_articulo", $resultado[$i]["codigo_articulo"]);
                $sentencia->execute();
            }
            
            //Terminar la transacción
            $this->dblink->commit();
            
            return true;
                    
        } catch (Exception $exc) {
            $this->dblink->rollBack(); //Extornar toda la transacción
            throw $exc;
        }
    }
    
    public function reporteVenta($fecha, $cliente, $comprobante){
        
        try {
            $sql = "select * from fn_reporte_venta(:p_fecha, :p_cliente, :p_tipo);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $fecha);
            $sentencia->bindParam(":p_cliente", $cliente);
            $sentencia->bindParam(":p_tipo", $comprobante);
            
            $sentencia->execute();           
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }

        public function reporteVentaAnio($fecha){
        
        try {
            $sql = "select * from fn_obtener_ventas_anio(:p_fecha);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $fecha);
            
            $sentencia->execute();           
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
        public function cargarVentaAnio(){
        try {
            $sql = " SELECT distinct to_char(fecha_venta , 'YYYY') as anio from venta;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}

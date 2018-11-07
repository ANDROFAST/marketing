<?php

require_once '../datos/Conexion.clase.php';

class TipoComprobante extends Conexion {

    private $codigoComprobante;
    private $descripcion;
    
    public function getCodigoComprobante()
    {
        return $this->codigoComprobante;
    }
    
    public function setCodigoComprobante($codigoComprobante)
    {
        $this->codigoComprobante = $codigoComprobante;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function cargarTipoComprobante(){
        try {
            $sql = "select * from tipo_comprobante order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listar(){
    try {
            $sql = "select * from tipo_comprobante order by 2;";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

     public function eliminar( $p_codigo_tipo_comprobante ){
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from tipo_comprobante where codigo_tipo_comprobante = :p_codigo_tipo_comprobante";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipo_comprobante", $p_codigo_tipo_comprobante);
            $sentencia->execute();
            
            $this->dblink->commit();
            
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

        public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('tipocomprobante') as tipC";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["tipC"];
                $this->setCodigoTipo($nuevoCodigo);
                
                $sql = "
                        INSERT INTO tipo_comprobante(
                                codigo_tipo_comprobante, 
                                descripcion)
                        VALUES (:p_codigo_tipo_comprobante, 
                                :p_descripcion);
                    ";
                
                //Preparar la sentencia
                $sentencia = $this->dblink->prepare($sql);
                
                //Asignar un valor a cada parametro
                $sentencia->bindParam(":p_codigo_tipo_comprobante", $this->getCodigoComprobante());
                $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                
                //Ejecutar la sentencia preparada
                $sentencia->execute();
                
                
                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'tipocomprobante'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                
                return true; //significa que todo se ha ejecutado correctamente
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla tipocomprobante");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack(); //Extornar toda la transacción
            throw $exc;
        }
        
        return false;       
    }

    
}

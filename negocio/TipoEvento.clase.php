<?php

require_once '../datos/Conexion.clase.php';

class TipoEvento extends Conexion {

private $codigoEvento;
private $descripcion;


public function getCodigoEvento()
{
    return $this->codigoEvento;
}

public function setCodigoEvento($codigoEvento)
{
    $this->codigoEvento = $codigoEvento;
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


    public function listar(){
    try {
            $sql = "select * from tipo_evento order by 2;";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
            public function leerDatos($p_codigo_tipo_evento) {
        try {
            $sql = "
                      select
                            t.*
                    from
                            tipo_evento t 
                    where
                            t.codigo_tipo_evento= :p_codigo_tipo_evento
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipo_evento", $p_codigo_tipo_evento);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }

 public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('tipo_evento') as tip";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["tip"];
                $this->setCodigoEvento($nuevoCodigo);
                
                $sql = "
                        INSERT INTO tipo_evento(
                                codigo_tipo_evento, 
                                descripcion)
                        VALUES (:p_codigo_tipo_evento, 
                                :p_descripcion);
                    ";
                
                //Preparar la sentencia
                $sentencia = $this->dblink->prepare($sql);
                
                //Asignar un valor a cada parametro
                $sentencia->bindParam(":p_codigo_tipo_evento", $this->getCodigoEvento());
                $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                
                //Ejecutar la sentencia preparada
                $sentencia->execute();
                
                
                //Actualizar el correlativo en +1
                $sql = "update correlativo set numero = numero + 1 where tabla = 'tipo_evento'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
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

    public function cargarTipoEvento(){
        try {
            $sql = "select * from tipo_evento order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarEventos() {
    try {
                $sql = "select 
            evento.codigo_evento,
           cliente.NOMBRES, 
           cliente.telefono_movil,
           evento.descripcion as evento,
           fecha_evento.fecha
        FROM 
                public.cliente, 
                public.evento, 
                public.fecha_evento
        WHERE 
            cliente.codigo_cliente = fecha_evento.codigo_cliente AND
            evento.codigo_evento = fecha_evento.codigo_evento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

     public function eliminar( $p_codigoEvento ){
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from tipo_evento where codigo_tipo_evento = :p_codigoEvento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoEvento", $p_codigoEvento);
            $sentencia->execute();
            
            $this->dblink->commit();
            
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

        public function editar() {
        $this->dblink->beginTransaction();
        
        try {
           $sql = " 
                 update tipo_evento set
                        descripcion            = :p_descripcion
                 where
                        codigo_tipo_evento     = :p_codigo_tipo_evento
               ";
   
           //Preparar la sentencia
            $sentencia = $this->dblink->prepare($sql);

            //Asignar un valor a cada parametro
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->bindParam(":p_codigo_tipo_evento", $this->getCodigoEvento());

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

}
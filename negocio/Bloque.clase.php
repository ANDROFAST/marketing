<?php

require_once '../datos/Conexion.clase.php';

class Bloque extends Conexion{
    private $codigoBloque;
    private $codigoEncuesta;
    private $nombre;
    private $orden;
    
    function getCodigoBloque() {
        return $this->codigoBloque;
    }

    function getCodigoEncuesta() {
        return $this->codigoEncuesta;
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getOrden() {
        return $this->orden;
    }

    function setCodigoBloque($codigoBloque) {
        $this->codigoBloque = $codigoBloque;
    }

    function setCodigoEncuesta($codigoEncuesta) {
        $this->codigoEncuesta = $codigoEncuesta;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function setOrden($orden) {
        $this->orden = $orden;
    }    
    
    public function listar(){
	try {
            $sql = "select b.id_encuesta, b.id_bloque, b.orden_bloque, b.nombre_bloque as blo, e.nombre_encuesta  as enc
                    from encuesta_bloque b inner join encuesta e on b.id_encuesta=e.id_encuesta
                    order by orden_bloque";
            
            $sentencia = $this->dblink->prepare($sql);
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
                $sql = "select Max(id_bloque):: integer +1 as num from encuesta_bloque where id_encuesta= :p_codigo_enc";
                $sentenciaC = $this->dblink->prepare($sql);
        
                $sentenciaC->bindParam(":p_codigo_enc",$this->getCodigoEncuesta());
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoBloque($nuevoCodigo);
                    $sql="INSERT INTO encuesta_bloque(id_encuesta, id_bloque, nombre_bloque, orden_bloque)
                        VALUES(:p_codigo_enc, :p_codigo_blo, :p_nombre, :p_orden);";

                     $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_enc",$this->getCodigoEncuesta());
                    $sentencia->bindParam(":p_codigo_blo",$this->getCodigoBloque()); 
                    $sentencia->bindParam(":p_nombre",$this->getNombre()); 
                    $sentencia->bindParam(":p_orden",$this->getOrden());  
                    $sentencia->execute();
                    $this->dblink->commit();                          
                                      
                }
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }

    
        public function editar(){
          $this->dblink->beginTransaction();
        try {                
                
                $sql="UPDATE encuesta_bloque SET nombre_bloque= :p_nombre, orden_bloque= :p_orden
                      WHERE id_encuesta = :p_id_enc and id_bloque= :p_id_blo ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_enc", $this->getCodigoEncuesta());
                $sentencia->bindParam(":p_id_blo", $this->getCodigoBloque());
                $sentencia->bindParam(":p_nombre",$this->getNombre());   
                $sentencia->bindParam(":p_orden",$this->getOrden()); 
                $sentencia->execute();

                $this->dblink->commit();                                          
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }
    
    public function eliminar() {
        try {
            
            $sql = "delete from encuesta_bloque where id_encuesta = :p_id_enc and id_bloque= :p_id_blo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_enc", $this->getCodigoEncuesta());
            $sentencia->bindParam(":p_id_blo", $this->getCodigoBloque());
            $sentencia->execute();
            
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigoenc, $codigoblo) {
        try {
            $sql = "
                SELECT id_encuesta, nombre_bloque,orden_bloque, id_bloque
                FROM encuesta_bloque
                WHERE id_encuesta = :p_id_enc and id_bloque = :p_id_blo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_enc", $codigoenc);
            $sentencia->bindParam(":p_id_blo", $codigoblo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
        public function cargarEncuestas(){
        try {
            $sql = "select * from encuesta order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
      public function cargarBloquesPorEncuestas($p_prov){
        try {
            $sql = "select id_bloque, nombre_bloque
                from encuesta_bloque where id_encuesta = :p_prov
                order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_prov", $p_prov);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }      
    }


}

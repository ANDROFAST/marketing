<?php

require_once '../datos/Conexion.clase.php';

class Area extends Conexion {
    private $codigoArea;
    private $descripcion;
    
    function getCodigoArea() {
        return $this->codigoArea;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigoArea($codigoArea) {
        $this->codigoArea = $codigoArea;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
   
   public function listar(){
	try {
            $sql = "select * from area order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'area'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoArea($nuevoCodigo);

                    $sql="INSERT INTO area(codigo_area, descripcion)
                        VALUES (:p_codigo_area, :p_descripcion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_area",$this->getCodigoArea());
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'area'";
                    $sentenciaCO = $this->dblink->prepare($sql);
                    $sentenciaCO->execute();
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
                
                $sql="UPDATE area SET descripcion= :p_descripcion
                      WHERE codigo_area= :p_codigo_area;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_area",$this->getCodigoArea());
                $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
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
            $sql = "delete from area where codigo_area = :p_codigo_area";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_area", $this->getCodigoArea());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_area, descripcion
                FROM area
                WHERE codigo_area = :p_codigo_area";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_area", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}

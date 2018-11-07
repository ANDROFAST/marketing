<?php

require_once '../datos/Conexion.clase.php';

class Cargo extends Conexion {
private $codigoCargo;
private $descripcion;

public function getCodigoCargo()
{
    return $this->codigoCargo;
}

public function setCodigoCargo($codigoCargo)
{
    $this->codigoCargo = $codigoCargo;
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
            $sql = "select * from cargo order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'cargo'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoCargo($nuevoCodigo);

                    $sql="INSERT INTO cargo(codigo_cargo, descripcion)
                        VALUES (:p_codigo_cargo, :p_descripcion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_cargo",$this->getCodigoCargo());
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'cargo'";
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
                
                $sql="UPDATE cargo SET descripcion= :p_descripcion
                      WHERE codigo_cargo= :p_codigo_cargo;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_cargo",$this->getCodigoCargo());
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
            $sql = "delete from cargo where codigo_cargo = :p_codigo_cargo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cargo", $this->getCodigoCargo());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_cargo, descripcion
                FROM cargo
                WHERE codigo_cargo = :p_codigo_cargo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cargo", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}



<?php

require_once '../datos/Conexion.clase.php';

class Departamento extends Conexion{
    private $codigoDepartamento;
    private $nombre;
    
    function getCodigoDepartamento() {
        return $this->codigoDepartamento;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigoDepartamento($codigoDepartamento) {
        $this->codigoDepartamento = $codigoDepartamento;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    
    public function listar(){
	try {
            $sql = "select * from departamento order by 2;";
            
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
                $sql = "select Max(codigo_departamento):: integer +1 as num from departamento";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoDepartamento($nuevoCodigo);

                    $sql="INSERT INTO departamento(codigo_departamento, nombre)
                        VALUES (:p_codigo_dep, :p_nombre);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_dep",$this->getCodigoDepartamento());
                    $sentencia->bindParam(":p_nombre",$this->getNombre());               
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
                
                $sql="UPDATE departamento SET nombre= :p_nombre
                      WHERE codigo_departamento= :p_codigo_dep;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_dep",$this->getCodigoDepartamento());
                $sentencia->bindParam(":p_nombre",$this->getNombre());               
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
            $sql = "delete from departamento where codigo_departamento = :p_codigo_dep";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $this->getCodigoDepartamento());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_departamento, nombre
                FROM departamento
                WHERE codigo_departamento = :p_codigo_dep";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}

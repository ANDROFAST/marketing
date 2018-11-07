<?php

require_once '../datos/Conexion.clase.php';
class Categoria extends Conexion{
    private $codigoCategoria;
    private $descripcion;
    
    function getCodigoCategoria() {
        return $this->codigoCategoria;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigoCategoria($codigoCategoria) {
        $this->codigoCategoria = $codigoCategoria;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function listar(){
	try {
            $sql = "select * from categoria order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'categoria'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoCategoria($nuevoCodigo);

                    $sql="INSERT INTO categoria(codigo_categoria, descripcion)
                        VALUES (:p_codigo_categoria, :p_descripcion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_categoria",$this->getCodigoCategoria());
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'categoria'";
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
                
                $sql="UPDATE categoria SET descripcion= :p_descripcion
                      WHERE codigo_categoria= :p_codigo_categoria;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_categoria",$this->getCodigoCategoria());
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
            $sql = "delete from categoria where codigo_categoria = :p_codigo_categoria";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_categoria", $this->getCodigoCategoria());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_categoria, descripcion
                FROM categoria
                WHERE codigo_categoria = :p_codigo_categoria";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_categoria", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}

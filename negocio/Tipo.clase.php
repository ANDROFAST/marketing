<?php

require_once '../datos/Conexion.clase.php';

class Tipo extends Conexion {
    private $codigoTipo;    
    private $descripcion;
    private $codigoCategoria;
    
    public function getCodigoTipo()
    {
        return $this->codigoTipo;
    }
    
    public function setCodigoTipo($codigoTipo)
    {
        $this->codigoTipo = $codigoTipo;
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
    
    function getCodigoCategoria() {
        return $this->codigoCategoria;
    }

    function setCodigoCategoria($codigoCategoria) {
        $this->codigoCategoria = $codigoCategoria;
    }

    public function cargarListaDatos(){
        try {
            $sql = "select * from tipo order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    public function listarCombosModalPrin( $codigo ){
        try {
            $sql = "select * from 
                tipo where 
                codigo_categoria = :p_codigo_categoria";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_categoria", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listar(){
	try {
            $sql = "select t.codigo_tipo, t.descripcion as tipo, t.codigo_categoria,c.descripcion as cat from tipo t inner join categoria c on t.codigo_categoria=c.codigo_categoria order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'tipo'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoTipo($nuevoCodigo);

                    $sql="INSERT INTO tipo(codigo_tipo, descripcion, codigo_categoria)
                        VALUES (:p_codigo_tipo, :p_descripcion, :p_codigo_categoria);";

                    $sentencia = $this->dblink->prepare($sql);                    
                    $sentencia->bindParam(":p_codigo_tipo",$this->getCodigoTipo());               
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->bindParam(":p_codigo_categoria",$this->getCodigoCategoria());
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'tipo'";
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
                
                $sql="UPDATE tipo SET descripcion= :p_descripcion, codigo_categoria=:p_codigo_categoria
                      WHERE codigo_tipo= :p_codigo_tipo;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_tipo",$this->getCodigoTipo());                
                $sentencia->bindParam(":p_descripcion",$this->getDescripcion());         
                $sentencia->bindParam(":p_codigo_categoria",$this->getCodigoCategoria());
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
            $sql = "delete from tipo where codigo_tipo = :p_codigo_tipo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipo", $this->getCodigoTipo());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_tipo, descripcion, codigo_categoria
                FROM tipo
                WHERE codigo_tipo = :p_codigo_tipo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipo", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


    
    

    
}

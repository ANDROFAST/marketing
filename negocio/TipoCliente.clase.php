<?php
require_once '../datos/Conexion.clase.php';
class TipoCliente extends Conexion{
    private $codigoTipoCliente;
    private $descripcion;
    
    function getCodigoTipoCliente() {
        return $this->codigoTipoCliente;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigoTipoCliente($codigoTipoCliente) {
        $this->codigoTipoCliente = $codigoTipoCliente;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    
   public function listar(){
	try {
            $sql = "select * from tipo_cliente order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'tipo_cliente'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoTipoCliente($nuevoCodigo);

                    $sql="INSERT INTO tipo_cliente(codigo_tipocliente, descripcion)
                        VALUES (:p_codigo_tipocliente, :p_descripcion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_tipocliente",$this->getCodigoTipoCliente());
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'tipo_cliente'";
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
                
                $sql="UPDATE tipo_cliente SET descripcion= :p_descripcion
                      WHERE codigo_tipocliente= :p_codigo_tipocliente;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_tipocliente",$this->getCodigoTipoCliente());
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
            $sql = "delete from tipo_cliente where codigo_tipocliente = :p_codigo_tipocliente";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipocliente", $this->getCodigoTipoCliente());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_tipocliente, descripcion
                FROM tipo_cliente
                WHERE codigo_tipocliente = :p_codigo_tipocliente";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_tipocliente", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}

<?php

require_once '../datos/Conexion.clase.php';

class Preguntas extends Conexion {
 private $codigoPregunta;
 private $descripcion;

 public function getCodigoPregunta()
 {
     return $this->codigoPregunta;
 }
 
 public function setCodigoPregunta($codigoPregunta)
 {
     $this->codigoPregunta = $codigoPregunta;
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
            $sql = "select * from preguntas order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'preguntas'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoPregunta($nuevoCodigo);

                    $sql="INSERT INTO preguntas(codigo_pregunta, descripcion)
                        VALUES (:p_codigo_pregunta, :p_descripcion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_pregunta",$this->getCodigoPregunta());
                    $sentencia->bindParam(":p_descripcion",$this->getDescripcion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'preguntas'";
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
                
                $sql="UPDATE preguntas SET descripcion= :p_descripcion
                      WHERE codigo_pregunta= :p_codigo_pregunta;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_pregunta",$this->getCodigoPregunta());
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
            $sql = "delete from preguntas where codigo_pregunta = :p_codigo_pregunta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_pregunta", $this->getCodigoPregunta());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT codigo_pregunta, descripcion
                FROM preguntas
                WHERE codigo_pregunta = :p_codigo_pregunta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_pregunta", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
      public function cargarListaDatos() {
	try {
            $sql = "select * from preguntas order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}

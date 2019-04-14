<?php

require_once '../datos/Conexion.clase.php';

class Encuesta extends Conexion {
 private $id;
 private $nombre;

 public function getId()
 {
     return $this->id;
 }
 
 public function setId($id)
 {
     $this->id = $id;
     return $this;
 }

public function getNombre()
{
    return $this->nombre;
}

public function setNombre($nombre)
{
    $this->nombre = $nombre;
    return $this;
}

    public function listar(){
	try {
            $sql = "select * from encuesta order by 2;";
            
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
                $sql = "select Max(id_encuesta):: integer +1 as num from encuesta";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setId($nuevoCodigo);

                    $sql="INSERT INTO encuesta(id_encuesta, nombre_encuesta)
                        VALUES (:p_codigo, :p_nombre);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo",$this->getId());
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
                
                $sql="UPDATE encuesta SET nombre_encuesta= :p_nombre_encuesta
                      WHERE id_encuesta= :p_id_encuesta;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_encuesta",$this->getId());
                $sentencia->bindParam(":p_nombre_encuesta",$this->getNombre());               
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
            $sql = "delete from encuesta where id_encuesta = :p_id_encuesta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_encuesta", $this->getId());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT id_encuesta, nombre_encuesta
                FROM encuesta
                WHERE id_encuesta = :p_id_encuesta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_encuesta", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
      public function cargarListaDatos() {
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
    
        public function cargarEncuestaBloque($p_encu){
        try {
            $sql = "id_bloque, nombre_bloque
                from encuesta_bloque where id_encuesta = :p_encu
                order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_encu", $p_encu);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }      
    }

}

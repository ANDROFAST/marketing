<?php

require_once '../datos/Conexion.clase.php';

class Pregunta extends Conexion {

    private $codigoBloque;
    private $codigoEncuesta;
    private $codigoPregunta;
    private $nombrePregunta;
    private $ordenPregunta;
    
  function getCodigoBloque() {
        return $this->codigoBloque;
    }

  function getCodigoEncuesta() {
        return $this->codigoEncuesta;
    }

  function getCodigoPregunta() {
        return $this->codigoPregunta;
    }
    
  function getNombrePregunta() {
        return $this->nombrePregunta;
    }
function getOrdenPregunta() {
        return $this->ordenPregunta;
    }
    
  function setCodigoBloque($codigoBloque) {
        $this->codigoBloque = $codigoBloque;
    }

  function setCodigoEncuesta($codigoEncuesta) {
        $this->codigoEncuesta = $codigoEncuesta;
    }

  function setCodigoPregunta($codigoPregunta) {
        $this->codigoPregunta = $codigoPregunta;
    }
    
    function setNombrePregunta($nombrePregunta) {
        $this->nombrePregunta = $nombrePregunta;
    }
    
function setOrdenPregunta($ordenPregunta) {
        $this->ordenPregunta = $ordenPregunta;
    }
   

    public function listar() {
        try {
            $sql = "select * from encuesta_pregunta";

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
            $sql = "select Max(id_pregunta):: integer +1 as num from encuesta_pregunta where id_encuesta= :p_id_encuesta and id_bloque = :p_id_bloque";
            $sentenciaC = $this->dblink->prepare($sql);
            $sentenciaC->bindParam(":p_id_encuesta", $this->getCodigoEncuesta());
            $sentenciaC->bindParam(":p_id_bloque", $this->getCodigoBloque());
            $sentenciaC->execute();
            $resultadoC = $sentenciaC->fetch();

            if ($sentenciaC->rowCount()) {
                $nuevoCodigo = $resultadoC["num"];
                $var2;
                if ($nuevoCodigo === 1) {
                    $var2 = '01';
                }
                if ($nuevoCodigo === 2) {
                    $var2 = '02';
                }
                if ($nuevoCodigo === 3) {
                    $var2 = '03';
                }
                if ($nuevoCodigo === 4) {
                    $var2 = '04';
                }
                if ($nuevoCodigo === 5) {
                    $var2 = '05';
                }
                if ($nuevoCodigo === 6) {
                    $var2 = '06';
                }
                if ($nuevoCodigo === 7) {
                    $var2 = '07';
                }
                if ($nuevoCodigo === 8) {
                    $var2 = '08';
                }
                if ($nuevoCodigo === 9) {
                    $var2 = '09';
                }
                if ($nuevoCodigo != 9 && $nuevoCodigo != 8 && $nuevoCodigo != 7 && $nuevoCodigo != 6 && $nuevoCodigo != 5 && $nuevoCodigo != 4 && $nuevoCodigo != 3 && $nuevoCodigo != 2 && $nuevoCodigo != 1) {
                    $var2 = $nuevoCodigo;
                }

                $this->setCodigoPregunta($var2);

                $sql = "INSERT INTO encuesta_pregunta(id_encuesta, id_bloque, id_pregunta, orden_pregunta,titulo_pregunta)
                        VALUES(:p_id_encuesta, :p_id_bloque, :p_id_pregunta, :p_orden_pregunta, :p_titulo_pregunta);";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_encuesta", $this->getCodigoEncuesta());
                $sentencia->bindParam(":p_id_bloque", $this->getCodigoBloque());
                $sentencia->bindParam(":p_id_pregunta", $this->getCodigoPregunta());
                $sentencia->bindParam(":p_orden_pregunta", $this->getOrdenPregunta());
                $sentencia->bindParam(":p_titulo_pregunta", $this->getNombrePregunta());
                $sentencia->execute();
                $this->dblink->commit();
            }
        } catch (Exception $exec) {
            $this->dblink->rollBack();
            throw $exec;
        }
        return true;
    }

    public function editar() {
        $this->dblink->beginTransaction();
        try {

            $sql = "UPDATE encuesta_pregunta SET titulo_pregunta= :p_titulo_pregunta,orden_pregunta= :p_orden_pregunta
                      WHERE id_encuesta = :p_id_encuesta and id_bloque= :p_id_bloque and id_pregunta= :p_id_pregunta";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_encuesta", $this->getCodigoEncuesta());
            $sentencia->bindParam(":p_id_bloque", $this->getCodigoBloque());
            $sentencia->bindParam(":p_id_pregunta", $this->getCodigoPregunta());
            $sentencia->bindParam(":p_titulo_pregunta", $this->getNombrePregunta());
             $sentencia->bindParam(":p_orden_pregunta", $this->getOrdenPregunta());
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

            $sql = "delete from encuesta_pregunta where id_encuesta = :p_id_encuesta and id_bloque= :p_id_bloque and id_pregunta= :p_id_pregunta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_encuesta", $this->getCodigoEncuesta());
            $sentencia->bindParam(":p_id_bloque", $this->getCodigoBloque());
            $sentencia->bindParam(":p_id_pregunta", $this->getCodigoPregunta());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }

    public function leerDatos($idencuesta, $idbloque, $idpregunta) {
        try {
            $sql = "
                SELECT id_encuesta, titulo_pregunta, orden_pregunta, id_bloque, id_pregunta
                FROM encuesta_pregunta
                WHERE id_encuesta = :p_id_encuesta and id_bloque= :p_id_bloque and id_pregunta= :p_id_pregunta";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_encuesta", $idencuesta);
            $sentencia->bindParam(":p_id_bloque", $idbloque);
            $sentencia->bindParam(":p_id_pregunta", $idpregunta);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function cargarEncuesta(){
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

}

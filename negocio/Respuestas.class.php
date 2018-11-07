<?php

require_once '../datos/Conexion.clase.php';

class Respuestas extends Conexion{
    private $codigoRespuesta;
    private $descripcion;
    private $valor;
    private $codigoPregunta;
    
    function getCodigoRespuesta() {
        return $this->codigoRespuesta;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getValor() {
        return $this->valor;
    }

    function getCodigoPregunta() {
        return $this->codigoPregunta;
    }

    function setCodigoRespuesta($codigoRespuesta) {
        $this->codigoRespuesta = $codigoRespuesta;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setCodigoPregunta($codigoPregunta) {
        $this->codigoPregunta = $codigoPregunta;
    }
    
    public function listar( $p_codigoPregunta ) {
        try {
            $sql = "select * from f_listar_respuestas( :p_codigoPregunta)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoPregunta", $p_codigoPregunta);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    


}

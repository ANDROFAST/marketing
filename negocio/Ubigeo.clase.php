<?php
require_once '../datos/Conexion.clase.php';

class Ubigeo extends Conexion {
    
    public function cargarDepartamentos(){
        try {
            $sql = "select * from departamento order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
    public function cargarProvinciasPorDepartamento($p_prov){
        try {
            $sql = "select codigo_provincia, nombre
                from provincia where codigo_departamento = :p_prov
                order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_prov", $p_prov);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }      
    }
    
    public function cargarDistritos($p_dep, $p_prov){
        try {
            $sql = "select codigo_distrito, nombre
                from distrito where codigo_departamento = :p_dep and
                     codigo_provincia = :p_prov
                order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dep", $p_dep);
            $sentencia->bindParam(":p_prov", $p_prov);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }      
    }
}

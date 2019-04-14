<?php

require_once '../datos/Conexion.clase.php';

class Distrito extends Conexion{
    private $codigoProvincia;
    private $codigoDep;
    private $codigoDistrito;
    private $nombre;
    
    function getCodigoProvincia() {
        return $this->codigoProvincia;
    }

    function getCodigoDep() {
        return $this->codigoDep;
    }

    function getCodigoDistrito() {
        return $this->codigoDistrito;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigoProvincia($codigoProvincia) {
        $this->codigoProvincia = $codigoProvincia;
    }

    function setCodigoDep($codigoDep) {
        $this->codigoDep = $codigoDep;
    }

    function setCodigoDistrito($codigoDistrito) {
        $this->codigoDistrito = $codigoDistrito;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    
    public function listar(){
	try {
            $sql = "select d.codigo_departamento, d.codigo_provincia,d.codigo_distrito, d.nombre as dist, p.nombre as prov, dep.nombre  as dep
                    from provincia p inner join departamento dep on p.codigo_departamento=dep.codigo_departamento
                                    inner join distrito d on (p.codigo_departamento=d.codigo_departamento and p.codigo_provincia=d.codigo_provincia)
                    ";
            
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
                $sql = "select Max(codigo_distrito):: integer +1 as num from distrito where codigo_departamento= :p_codigo_dep and codigo_provincia = :p_codigo_prov";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->bindParam(":p_codigo_dep",$this->getCodigoDep());
                $sentenciaC->bindParam(":p_codigo_prov",$this->getCodigoProvincia());
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $var2;
                   if($nuevoCodigo===1){
                        $var2='01';
                    }
                    if($nuevoCodigo===2){
                        $var2='02';
                    }
                    if($nuevoCodigo===3){
                        $var2='03';
                    }
                    if($nuevoCodigo===4){
                        $var2='04';
                    }
                    if($nuevoCodigo===5){
                        $var2='05';
                    }
                    if($nuevoCodigo===6){
                        $var2='06';
                    }
                    if($nuevoCodigo===7){
                        $var2='07';
                    }
                    if($nuevoCodigo===8){
                        $var2='08';
                    }
                    if($nuevoCodigo===9){
                        $var2='09';
                    }
                    if($nuevoCodigo!=9 && $nuevoCodigo!=8 && $nuevoCodigo!=7 && $nuevoCodigo!=6 && $nuevoCodigo!=5 && $nuevoCodigo!=4 && $nuevoCodigo!=3 && $nuevoCodigo!=2 && $nuevoCodigo!=1){
                        $var2=$nuevoCodigo;
                    }
                    
                    $this->setCodigoDistrito($var2);                            

                    $sql="INSERT INTO distrito(codigo_departamento, codigo_provincia, codigo_distrito, nombre)
                        VALUES(:p_codigo_dep, :p_codigo_pro, :p_codigo_dis, :p_nombre);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_dep",$this->getCodigoDep());
                    $sentencia->bindParam(":p_codigo_pro",$this->getCodigoProvincia()); 
                    $sentencia->bindParam(":p_codigo_dis",$this->getCodigoDistrito()); 
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
                
                $sql="UPDATE distrito SET nombre= :p_nombre
                      WHERE codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro and codigo_distrito= :p_codigo_dis";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_dep", $this->getCodigoDep());
                $sentencia->bindParam(":p_codigo_pro", $this->getCodigoProvincia());
                $sentencia->bindParam(":p_codigo_dis", $this->getCodigoDistrito());
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
            
                $sql = "delete from distrito where codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro and codigo_distrito= :p_codigo_dis";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $this->getCodigoDep());
            $sentencia->bindParam(":p_codigo_pro", $this->getCodigoProvincia());
            $sentencia->bindParam(":p_codigo_dis", $this->getCodigoDistrito());
            $sentencia->execute();
            
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigodep, $codigopro, $codigodis) {
        try {
            $sql = "
                SELECT codigo_departamento, nombre, codigo_provincia, codigo_distrito
                FROM distrito
                WHERE codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro and codigo_distrito= :p_codigo_dis";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $codigodep);
            $sentencia->bindParam(":p_codigo_pro", $codigopro);
            $sentencia->bindParam(":p_codigo_dis", $codigodis);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }



}

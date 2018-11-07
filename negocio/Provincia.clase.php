<?php

require_once '../datos/Conexion.clase.php';

class Provincia extends Conexion{
    private $codigoProvincia;
    private $codigoDep;
    private $nombre;
    
    function getCodigoProvincia() {
        return $this->codigoProvincia;
    }

    function getCodigoDep() {
        return $this->codigoDep;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function listar(){
	try {
            $sql = "select p.codigo_departamento, p.codigo_provincia, p.nombre as prov, d.nombre  as dep
                    from provincia p inner join departamento d on p.codigo_departamento=d.codigo_departamento
                    order by 2";
            
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
                $sql = "select Max(codigo_provincia):: integer +1 as num from provincia where codigo_departamento= :p_codigo_dep";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->bindParam(":p_codigo_dep",$this->getCodigoDep());
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
                    
                    $this->setCodigoProvincia($var2);
              /*      
                    echo $this->getCodigoDep();
            echo $this->getCodigoProvincia();
            echo $this->getNombre();
            */
                

                    $sql="INSERT INTO provincia(codigo_departamento, codigo_provincia, nombre)
                        VALUES(:p_codigo_dep, :p_codigo_pro, :p_nombre);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_dep",$this->getCodigoDep());
                    $sentencia->bindParam(":p_codigo_pro",$this->getCodigoProvincia()); 
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
                
                $sql="UPDATE provincia SET nombre= :p_nombre
                      WHERE codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_dep", $this->getCodigoDep());
                $sentencia->bindParam(":p_codigo_pro", $this->getCodigoProvincia());
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
            
            $sql = "delete from provincia where codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $this->getCodigoDep());
            $sentencia->bindParam(":p_codigo_pro", $this->getCodigoProvincia());
            $sentencia->execute();
            
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigodep, $codigopro) {
        try {
            $sql = "
                SELECT codigo_departamento, nombre, codigo_provincia
                FROM provincia
                WHERE codigo_departamento = :p_codigo_dep and codigo_provincia= :p_codigo_pro";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_dep", $codigodep);
            $sentencia->bindParam(":p_codigo_pro", $codigopro);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


}

<?php

require_once '../datos/Conexion.clase.php';

class Usuario extends Conexion {
private $codigoUsuario;
private $dniUsuario;
private $clave;
private $estado;

public function getCodigoUsuario()
{
    return $this->codigoUsuario;
}

public function setCodigoUsuario($codigoUsuario)
{
    $this->codigoUsuario = $codigoUsuario;
    return $this;
}

public function getDniUsuario()
{
    return $this->dniUsuario;
}

public function setDniUsuario($dniUsuario)
{
    $this->dniUsuario = $dniUsuario;
    return $this;
}

public function getClave()
{
    return $this->clave;
}

public function setClave($clave)
{
    $this->clave = $clave;
    return $this;
}

public function getEstado()
{
    return $this->estado;
}

public function setEstado($estado)
{
    $this->estado = $estado;
    return $this;
}
   
    
    public function listar(){
        try {
            $sql = "
                        select  u.codigo_usuario, 
                                u.dni_usuario, 
                                (p.apellido_paterno||' '||p.apellido_materno||', '||p.nombres) as personal, 
                                (case when u.estado='A' then 'ACTIVO' else 'INACTIVO' end) as estado
                        from usuario u inner join personal p on u.dni_usuario=p.dni
                    ";
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function agregar(){
          $this->dblink->beginTransaction();
        try {
                $sql = "select numero+1 as num from correlativo where tabla = 'usuario'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoUsuario($nuevoCodigo);

                    $sql="INSERT INTO usuario(codigo_usuario, dni_usuario, clave, estado)
                            VALUES (:p_codigo_usuario, :p_dni_usuario, :p_clave, :p_estado_usu);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_usuario",$this->getCodigoUsuario());
                    $sentencia->bindParam(":p_dni_usuario",$this->getDniUsuario());               
                    $sentencia->bindParam(":p_clave",  md5($this->getClave()));               
                    $sentencia->bindParam(":p_estado_usu",$this->getEstado());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'usuario'";
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
                if($this->getClave()==''){
                    
                    $sql="UPDATE usuario SET estado= :p_estado_usu
                    WHERE codigo_usuario= :p_codigo_usuario";

                    $sentencia = $this->dblink->prepare($sql);                    
                    $sentencia->bindParam(":p_estado_usu",$this->getEstado());               
                    $sentencia->bindParam(":p_codigo_usuario",$this->getCodigoUsuario());               
                    $sentencia->execute();
                }else{
            
                    $sql="UPDATE usuario SET clave= :p_clave, estado= :p_estado_usu
                        WHERE codigo_usuario= :p_codigo_usuario";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_clave",  md5($this->getClave()));
                    $sentencia->bindParam(":p_estado_usu",$this->getEstado());               
                    $sentencia->bindParam(":p_codigo_usuario",$this->getCodigoUsuario());               
                    $sentencia->execute();
                }
                
                $this->dblink->commit();                                          
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }
    
    public function eliminar() {
        try {
            //$sql = "delete from usuario where codigo_usuario = :p_codigo_usuario";
            $sql = "UPDATE usuario set estado='I' where codigo_usuario = :p_codigo_usuario";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_usuario", $this->getCodigoUsuario());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                SELECT *
                FROM usuario
                WHERE codigo_usuario = :p_codigo_usuario";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_usuario", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
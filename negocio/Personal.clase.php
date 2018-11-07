<?php

require_once '../datos/Conexion.clase.php';

class Personal extends Conexion{
    
    private $dniPersonal;
    private $apellidoMaterno;
    private $apellidoPaterno;
    private $nombres;
    private $direccion;
    private $telefonoFijo;
    private $telefonoMovil1;
    private $telefonoMovil2;
    private $email;
    private $estadoPersonal;
    private $codigoCargo;
    private $codigoArea;
    private $dniJefe;
    
    function getDniPersonal() {
        return $this->dniPersonal;
    }

    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefonoFijo() {
        return $this->telefonoFijo;
    }

    function getTelefonoMovil1() {
        return $this->telefonoMovil1;
    }

    function getTelefonoMovil2() {
        return $this->telefonoMovil2;
    }

    function getEmail() {
        return $this->email;
    }

    function getEstadoPersonal() {
        return $this->estadoPersonal;
    }

    function getCodigoCargo() {
        return $this->codigoCargo;
    }

    function getCodigoArea() {
        return $this->codigoArea;
    }

    function getDniJefe() {
        return $this->dniJefe;
    }

    function setDniPersonal($dniPersonal) {
        $this->dniPersonal = $dniPersonal;
    }

    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefonoFijo($telefonoFijo) {
        $this->telefonoFijo = $telefonoFijo;
    }

    function setTelefonoMovil1($telefonoMovil1) {
        $this->telefonoMovil1 = $telefonoMovil1;
    }

    function setTelefonoMovil2($telefonoMovil2) {
        $this->telefonoMovil2 = $telefonoMovil2;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEstadoPersonal($estadoPersonal) {
        $this->estadoPersonal = $estadoPersonal;
    }

    function setCodigoCargo($codigoCargo) {
        $this->codigoCargo = $codigoCargo;
    }

    function setCodigoArea($codigoArea) {
        $this->codigoArea = $codigoArea;
    }

    function setDniJefe($dniJefe) {
        $this->dniJefe = $dniJefe;
    }
    
    public function listarJefe(){
	try {
            $sql = "select dni, (apellido_paterno||' '||apellido_materno||', '||nombres) as nombre 
		    from personal order by 2";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listarJefeEditar($dni){
	try {
            $sql = "
                    select dni, (apellido_paterno||' '||apellido_materno||', '||nombres) as nombre 
		    from personal 
                    where dni not in (select dni from personal where dni= :p_dniedit)
                    order by 2";
            
             $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dniedit", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


    public function listar(){
        try {
            $sql = "
                    SELECT  
                                p.dni, 
                                p.apellido_paterno, 
                                p.apellido_materno, 
                                p.nombres, 
                                p.direccion, 
                                p.telefono_fijo, 
                                p.telefono_movil1, 
                                p.telefono_movil2, 
                                p.email, 
                                (case when p.estado='A' then 'ACTIVO' else 'INACTIVO' end) as estado, 
                                c.descripcion as cargo,
                                a.descripcion as area,
                                (case when p2.apellido_paterno is null then '**** SIN JEFE ****' else (p2.apellido_paterno||' '||p2.apellido_materno||', '||p2.nombres) end) as jefe
                    FROM personal p inner join cargo c on p.codigo_cargo=c.codigo_cargo
                                  inner join area a on p.codigo_area=a.codigo_area
                                  left join personal p2 on p.dni_jefe=p2.dni
                    ";
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function leerDatos($dni) {
        try {
            $sql = "
                 SELECT  
                                p.dni, 
                                p.apellido_paterno, 
                                p.apellido_materno, 
                                p.nombres, 
                                p.direccion, 
                                p.telefono_fijo, 
                                p.telefono_movil1, 
                                p.telefono_movil2, 
                                p.email, 
                                (case when p.estado='A' then 'ACTIVO' else 'INACTIVO' end) as estado, 
                                p.estado,
                                c.descripcion as cargo,
                                c.codigo_cargo,
                                a.descripcion as area,
                                a.codigo_area,
                                dni_jefe
                    FROM personal p inner join cargo c on p.codigo_cargo=c.codigo_cargo
                                  inner join area a on p.codigo_area=a.codigo_area
                
                WHERE p.dni = :p_dni_personal ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni_personal", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function listarCombo(){
        try {
            $sql = "
                    SELECT p.dni, (p.apellido_paterno||' '||p.apellido_materno||', '||p.nombres) as nombrepersonal
                    FROM personal p
                    WHERE p.dni not in  (select dni_usuario from usuario)";
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
                    $sql="INSERT INTO personal(dni, apellido_paterno, apellido_materno, nombres, direccion, 
                                            telefono_fijo, telefono_movil1, telefono_movil2, email, codigo_cargo, codigo_area, dni_jefe, estado)
                          VALUES (:p_dni_personal, :p_apellido_paterno, :p_apellido_materno, :p_nombres, :p_direccion, 
                                :p_telefono_fijo, :p_telefono_movil1, :p_telefono_movil2, :p_email, :p_codigo_cargo, :p_codigo_area, :p_dni_jefe,:p_estado_personal);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_dni_personal",$this->getDniPersonal());
                    $sentencia->bindParam(":p_apellido_paterno",$this->getApellidoPaterno());               
                    $sentencia->bindParam(":p_apellido_materno",$this->getApellidoMaterno());               
                    $sentencia->bindParam(":p_nombres",$this->getNombres());               
                    $sentencia->bindParam(":p_direccion",$this->getDireccion());               
                    $sentencia->bindParam(":p_telefono_fijo",$this->getTelefonoFijo());               
                    $sentencia->bindParam(":p_telefono_movil1",$this->getTelefonoMovil1());               
                    $sentencia->bindParam(":p_telefono_movil2",$this->getTelefonoMovil2());               
                    $sentencia->bindParam(":p_email",$this->getEmail());               
                    $sentencia->bindParam(":p_estado_personal",$this->getEstadoPersonal());               
                    $sentencia->bindParam(":p_codigo_cargo",$this->getCodigoCargo());               
                    $sentencia->bindParam(":p_codigo_area",$this->getCodigoArea());               
                    $sentencia->bindParam(":p_dni_jefe",$this->getDniJefe());               
                    $sentencia->execute();
             
                   $this->dblink->commit();                          
             
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }
    
    public function editar(){
          $this->dblink->beginTransaction();
        try {
                
                $sql="UPDATE personal
                        SET apellido_paterno=:p_apellido_paterno, apellido_materno=:p_apellido_materno, nombres=:p_nombres, 
                            direccion=:p_direccion, telefono_fijo=:p_telefono_fijo, telefono_movil1=:p_telefono_movil1, telefono_movil2=:p_telefono_movil2, 
                            email=:p_email, estado=:p_estado_personal, codigo_cargo=:p_codigo_cargo, codigo_area=:p_codigo_area, dni_jefe= :p_dni_jefe
                      WHERE dni=:p_dni_personal ;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_dni_personal",$this->getDniPersonal());
                $sentencia->bindParam(":p_apellido_paterno",$this->getApellidoPaterno());               
                $sentencia->bindParam(":p_apellido_materno",$this->getApellidoMaterno());               
                $sentencia->bindParam(":p_nombres",$this->getNombres());               
                $sentencia->bindParam(":p_direccion",$this->getDireccion());               
                $sentencia->bindParam(":p_telefono_fijo",$this->getTelefonoFijo());               
                $sentencia->bindParam(":p_telefono_movil1",$this->getTelefonoMovil1());               
                $sentencia->bindParam(":p_telefono_movil2",$this->getTelefonoMovil2());               
                $sentencia->bindParam(":p_email",$this->getEmail());               
                $sentencia->bindParam(":p_estado_personal",$this->getEstadoPersonal());               
                $sentencia->bindParam(":p_codigo_cargo",$this->getCodigoCargo());               
                $sentencia->bindParam(":p_codigo_area",$this->getCodigoArea());               
                $sentencia->bindParam(":p_dni_jefe",$this->getDniJefe());                            
                $sentencia->execute();

                $this->dblink->commit();                                          
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }
    
    public function darBaja() {
        try {
            $sql = "update personal set estado='I' where dni = :p_dni_personal";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni_personal", $this->getDniPersonal());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
}

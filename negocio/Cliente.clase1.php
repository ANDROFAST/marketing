<?php

require_once '../datos/Conexion.clase.php';

class Cliente extends Conexion {
    private $codigoCliente;
    private $dni;
    private $ruc;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $nombres;
    private $razonSocial;    
    private $direccion;
    private $telefonoFijo;
    private $telefonoMovil;
    private $email;
    private $direccionWeb;
    private $codigoDepartamento;
    private $codigoProvincia;
    private $codigoDistrito;
    private $codigoTipoCliente;
    private $estado;
    private $fechaRegistro;
    private $clave;
    private $terCondicion;
    
    function getCodigoCliente() {
        return $this->codigoCliente;
    }

    function getDni() {
        return $this->dni;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getRazonSocial() {
        return $this->razonSocial;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefonoFijo() {
        return $this->telefonoFijo;
    }

    function getTelefonoMovil() {
        return $this->telefonoMovil;
    }

    function getEmail() {
        return $this->email;
    }

    function getDireccionWeb() {
        return $this->direccionWeb;
    }

    function getCodigoDepartamento() {
        return $this->codigoDepartamento;
    }

    function getCodigoProvincia() {
        return $this->codigoProvincia;
    }

    function getCodigoDistrito() {
        return $this->codigoDistrito;
    }

    function getCodigoTipoCliente() {
        return $this->codigoTipoCliente;
    }

    function getEstado() {
        return $this->estado;
    }

    function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefonoFijo($telefonoFijo) {
        $this->telefonoFijo = $telefonoFijo;
    }

    function setTelefonoMovil($telefonoMovil) {
        $this->telefonoMovil = $telefonoMovil;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDireccionWeb($direccionWeb) {
        $this->direccionWeb = $direccionWeb;
    }

    function setCodigoDepartamento($codigoDepartamento) {
        $this->codigoDepartamento = $codigoDepartamento;
    }

    function setCodigoProvincia($codigoProvincia) {
        $this->codigoProvincia = $codigoProvincia;
    }

    function setCodigoDistrito($codigoDistrito) {
        $this->codigoDistrito = $codigoDistrito;
    }

    function setCodigoTipoCliente($codigoTipoCliente) {
        $this->codigoTipoCliente = $codigoTipoCliente;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function getClave() {
        return $this->clave;
    }

    function getTerCondicion() {
        return $this->terCondicion;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setTerCondicion($terCondicion) {
        $this->terCondicion = $terCondicion;
    }

        
    public function editarClienteUsuario($p_clave, $p_codigo) {
        $this->dblink->beginTransaction();
        
        try {
           $sql = " 
                    update usuario_cliente set clave = md5(:p_clave) where codigo_cliente = :p_codigo_cliente;
               ";

           //Preparar la sentencia
            $sentencia = $this->dblink->prepare($sql);

            //Asignar un valor a cada parametro          
            $sentencia->bindParam(":p_clave", $p_clave);
            $sentencia->bindParam(":p_codigo_cliente", $p_codigo);
            
            //Ejecutar la sentencia preparada
            $sentencia->execute();
            
            
            $this->dblink->commit();
                
            return true;
            
        } catch (Exception $exc) {
           $this->dblink->rollBack();
           throw $exc;
        }
        
        return false;
            
    }
    
    public function leerClienteUsuario($p_codigo) {
        try {
            $sql = "
                    select *
                        from usuario_cliente ucl inner join cliente cl on ucl.codigo_cliente = cl.codigo_cliente
                        where ucl.codigo_usuario = :p_codigo
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo", $p_codigo);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
      public function cargarDatosCliente($nombre) {
        try {
            $sql="
                    select codigo_cliente, (apellido_paterno ||' '|| apellido_materno ||', '|| nombres)::character varying 
                    as nombregeneral,razon_social, apellido_paterno ||' '|| apellido_materno ||', '|| nombres 
                    as nombrecompleto, direccion, telefono_fijo, telefono_movil 
                    from cliente where lower(apellido_paterno ||' '|| apellido_materno ||', '|| nombres) like :p_nombregeneral and codigo_tipocliente=1
                    UNION
                    select codigo_cliente, (razon_social) ::character varying as nombregeneral, razon_social, apellido_paterno ||' '|| apellido_materno ||', '|| nombres as nombrecompleto,
                    direccion, telefono_fijo, telefono_movil 
                    from cliente where  lower(razon_social) like :p_nombregeneral and codigo_tipocliente=2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $nombre = '%'.  strtolower($nombre).'%';
            $sentencia->bindParam(":p_nombregeneral", $nombre);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }           
    }
  
    public function buscardnirucexistente($valor,$valortp) {
        try {
            
            if($valortp==1){ //persona natural
                $sql = "select * from cliente where dni= :p_dni";
                $sentencia = $this->dblink->prepare($sql);          
                $sentencia->bindParam(":p_dni", $valor);            
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);                
            }else{            //persona juridica
                $sql = "select * from cliente where ruc= :p_ruc";
                $sentencia = $this->dblink->prepare($sql);          
                $sentencia->bindParam(":p_ruc", $valor);            
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);                
            }
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listar() {
        try {
            $sql = "select p.codigo_cliente,p.dni::character(8) as NDocumento,  (p.apellido_paterno ||' '|| p.apellido_materno ||' '|| p.nombres)::character varying as cliente,
                            p.email, p.telefono_fijo, p.telefono_movil, p.direccion, p.fecha_registro, p.estado, tp.descripcion, p.direccion_web,concat(dp.nombre, '/', pr.nombre, '/', d.nombre) as ubigeo
                     from cliente p inner join tipo_cliente tp on p.codigo_tipocliente=tp.codigo_tipocliente
                                  inner join distrito d on (p.codigo_departamento, p.codigo_provincia, p.codigo_distrito) = (d.codigo_departamento, d.codigo_provincia, d.codigo_distrito)
                                  inner join provincia pr on (d.codigo_departamento, d.codigo_provincia) = (pr.codigo_departamento, pr.codigo_provincia)
                                  inner join departamento dp on pr.codigo_departamento = dp.codigo_departamento
                     where (p.apellido_paterno ||' '|| p.apellido_materno ||' '|| p.nombres) is not null and p.codigo_tipocliente=1 
                     UNION
                     select p.codigo_cliente,p.ruc::character(11) as NDocumento, (razon_social)::character varying as cliente, p.email, p.telefono_fijo, p.telefono_movil, p.direccion, 
                     p.fecha_registro, p.estado, tp.descripcion, p.direccion_web, concat(dp.nombre, '/', pr.nombre, '/', d.nombre) as ubigeo
                     from cliente p inner join tipo_cliente tp on p.codigo_tipocliente=tp.codigo_tipocliente 
                                  inner join distrito d on (p.codigo_departamento, p.codigo_provincia, p.codigo_distrito) = (d.codigo_departamento, d.codigo_provincia, d.codigo_distrito)
                                  inner join provincia pr on (d.codigo_departamento, d.codigo_provincia) = (pr.codigo_departamento, pr.codigo_provincia)
                                  inner join departamento dp on pr.codigo_departamento = dp.codigo_departamento
                     where (razon_social) is not null and  p.codigo_tipocliente=2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function getClientePorCodigo() {
        try {
            $sql = "select * from cliente where codigo_cliente = :p_codigo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo", $this->getCodigoCliente());
            $sentencia->execute();
            return $sentencia->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select numero+1 as nc from correlativo where tabla = 'cliente'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            if ($sentencia->rowCount()) {
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigoCliente($nuevoCodigo);

                $sql = "INSERT INTO cliente(
                                    codigo_cliente, 
                                    dni, 
                                    ruc, 
                                    apellido_paterno, 
                                    apellido_materno, 
                                    nombres, 
                                    razon_social, 
                                    direccion, 
                                    telefono_fijo, 
                                    telefono_movil, 
                                    email, 
                                    direccion_web, 
                                    codigo_departamento, 
                                    codigo_provincia, 
                                    codigo_distrito, 
                                    codigo_tipocliente, 
                                    estado,
                                    ter_condicion,
                                    clave)
                            values (:p_codigo, 
                                    :p_dni, 
                                    :p_ruc, 
                                    :p_apepat, 
                                    :p_apemat, 
                                    :p_nombres,
                                    :p_razon, 
                                    :p_direccion, 
                                    :p_telFijo,
                                    :p_telMovil,
                                    :p_email, 
                                    :p_direccion_web, 
                                    :p_cod_dep, 
                                    :p_cod_pro, 
                                    :p_cod_dist,
                                    :p_tc, 
                                    :p_estado, 
                                    :p_ter_condicion,
                                    :p_clave)";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo", $this->getCodigoCliente());
                $sentencia->bindParam(":p_dni", $this->getDni());
                $sentencia->bindParam(":p_ruc", $this->getRuc());
                $sentencia->bindParam(":p_apepat", $this->getApellidoPaterno());
                $sentencia->bindParam(":p_apemat", $this->getApellidoMaterno());
                $sentencia->bindParam(":p_nombres", $this->getNombres());
                $sentencia->bindParam(":p_razon", $this->getRazonSocial());
                $sentencia->bindParam(":p_direccion", $this->getDireccion());                
                $sentencia->bindParam(":p_telFijo", $this->getTelefonoFijo());
                $sentencia->bindParam(":p_telMovil", $this->getTelefonoMovil());
                $sentencia->bindParam(":p_email", $this->getEmail());
                $sentencia->bindParam(":p_direccion_web", $this->getDireccionWeb());  
                $sentencia->bindParam(":p_cod_dep", $this->getCodigoDepartamento());
                $sentencia->bindParam(":p_cod_pro", $this->getCodigoProvincia());
                $sentencia->bindParam(":p_cod_dist", $this->getCodigoDistrito());
                $sentencia->bindParam(":p_tc", $this->getCodigoTipoCliente());
                $sentencia->bindParam(":p_estado", $this->getEstado());
                $sentencia->bindParam(":p_ter_condicion", $this->getTerCondicion());
                $sentencia->bindParam(":p_clave", $this->getClave());
                $sentencia->execute();   
                
                $sql = "update correlativo set numero = numero + 1 where tabla = 'cliente'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();

                $this->dblink->commit();
            }
        }

        catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
        return true;
    }

    public function eliminar() {
        try {
            $sql = "update cliente set estado = 'I' where codigo_cliente = :p_codigo_cliente";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cliente", $this->getCodigoCliente());
            $sentencia->execute();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return true;
    }
    
    public function modificarCliNatural() {
        $this->dblink->beginTransaction();

        try {
            
                $sql = "update cliente set dni=:p_dni, apellido_paterno=:p_apepaterno, 
                    apellido_materno=:p_apematerno, nombres=:p_nombres, 
                    email= :p_email, telefono_fijo= :p_telfijo,
                    telefono_movil=:p_telmovil, direccion= :p_direccion, fecha_registro= :p_fecha, estado=:p_estado,
                    codigo_departamento= :p_codigo_departamento, codigo_provincia= :p_codigo_provincia, codigo_distrito= :p_codigo_distrito
                    where codigo_cliente=:p_codigo";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo", $this->getCodigoCliente());
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->bindParam(":p_apepaterno", $this->getApellidoPaterno());
            $sentencia->bindParam(":p_apematerno", $this->getApellidoMaterno());
            $sentencia->bindParam(":p_nombres", $this->getNombres());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_telfijo", $this->getTelefonoFijo());
            $sentencia->bindParam(":p_telmovil", $this->getTelefonoMovil());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_fecha", $this->getFechaRegistro());
            $sentencia->bindParam(":p_estado", $this->getEstado());
            $sentencia->bindParam(":p_codigo_departamento", $this->getCodigoDepartamento());
            $sentencia->bindParam(":p_codigo_provincia", $this->getCodigoProvincia());
            $sentencia->bindParam(":p_codigo_distrito", $this->getCodigoDistrito());


            $sentencia->execute();
            $this->dblink->commit();
        } catch (\Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
        return true;
    }
    
    public function modificarCliJuridico() {
        $this->dblink->beginTransaction();

        try {
           
                $sql = "update cliente set ruc= :p_ruc, razon_social= :p_razon, 
                    email= :p_email, telefono_fijo= :p_telfijo,
                        telefono_movil=:p_telmovil, direccion= :p_direccion, fecha_registro= :p_fecha, estado=:p_estado,
                        codigo_departamento= :p_codigo_departamento, codigo_provincia= :p_codigo_provincia, codigo_distrito= :p_codigo_distrito
                    where codigo_cliente=:p_codigo";
           
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo", $this->getCodigoCliente());
            $sentencia->bindParam(":p_ruc", $this->getRuc());
            $sentencia->bindParam(":p_razon", $this->getRazonSocial());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_telfijo", $this->getTelefonoFijo());
            $sentencia->bindParam(":p_telmovil", $this->getTelefonoMovil());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_fecha", $this->getFechaRegistro());
            $sentencia->bindParam(":p_estado", $this->getEstado());
            $sentencia->bindParam(":p_codigo_departamento", $this->getCodigoDepartamento());
            $sentencia->bindParam(":p_codigo_provincia", $this->getCodigoProvincia());
            $sentencia->bindParam(":p_codigo_distrito", $this->getCodigoDistrito());


            $sentencia->execute();
            $this->dblink->commit();
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
        return true;
    }


}

<?php

require_once '../datos/Conexion.clase.php';

class Articulo extends Conexion {
    private $codigoArticulo;
    private $nombre;
    private $precioVenta;
    private $stock;
    private $codigoTipo;
    private $estado;
    private $presentacion;
    private $foto;
    
    function getCodigoArticulo() {
        return $this->codigoArticulo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecioVenta() {
        return $this->precioVenta;
    }

    function setCodigoArticulo($codigoArticulo) {
        $this->codigoArticulo = $codigoArticulo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPrecioVenta($precioVenta) {
        $this->precioVenta = $precioVenta;
    }

   public function getCodigoTipo()
   {
       return $this->codigoTipo;
   }
   
   public function setCodigoTipo($codigoTipo)
   {
       $this->codigoTipo = $codigoTipo;
       return $this;
   }
   
   function getStock() {
       return $this->stock;
   }

   function getEstado() {
       return $this->estado;
   }

   function getPresentacion() {
       return $this->presentacion;
   }

   function setStock($stock) {
       $this->stock = $stock;
   }

   function setEstado($estado) {
       $this->estado = $estado;
   }

   function setPresentacion($presentacion) {
       $this->presentacion = $presentacion;
   }
   
   function getFoto() {
       return $this->foto;
   }

   function setFoto($foto) {
       $this->foto = $foto;
   }

   public function cargaDatosCarrito($p_codigo) {
        try {
            $sql = "select * from articulo where codigo_articulo = :p_codigo;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo", $p_codigo);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
    public function cargaDatos($p_categoria, $p_tipo) {
        try {
            $sql = "select * from fn_listar_articulos_venta(:p_categoria, :p_tipo);";
                        
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->bindParam(":p_categoria", $p_categoria);
            $sentencia->bindParam(":p_tipo", $p_tipo);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
   function cargarDatosArticulo( $nombre ){
       try{
           $sql = "select * from articulo where nombre ilike :p_nombre";
           
           $sentencia = $this->dblink->prepare($sql);
           $nombre = '%'.  strtolower($nombre).'%';
           $sentencia->bindParam(":p_nombre", $nombre);
           $sentencia->execute();
           $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
       } catch (Exception $ex) {
           throw $ex;
       }
    }

    
    public function listarPublico( $p_codigoCategoria, $p_tipo ) {
        try {
            $sql = "select * from fn_listar_articulos_venta(:p_categoria, :p_tipo);";
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->bindParam(":p_codigoCategoria", $p_codigoCategoria);
            $sentencia->bindParam(":p_tipo", $p_tipo);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
   public function listar(){
	try {
            $sql = "select a.codigo_articulo, a.nombre, a.presentacion, a.precio_venta, a.stock,c.descripcion as cat, t.descripcion as tip, 
                            (case when a.estado='A' then 'ACTIVO' else 'INACTIVO' end) as estado
                    from articulo a inner join tipo t on a.codigo_tipo=t.codigo_tipo
                    inner join categoria c on t.codigo_categoria=c.codigo_categoria 
                    order by 2;";
            
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
                $sql = "select numero+1 as num from correlativo where tabla = 'articulo'";
                $sentenciaC = $this->dblink->prepare($sql);
                $sentenciaC->execute();
                $resultadoC = $sentenciaC->fetch();
                
                if ($sentenciaC->rowCount()){
                    $nuevoCodigo = $resultadoC["num"];
                    $this->setCodigoArticulo($nuevoCodigo);

                    $sql="INSERT INTO articulo(codigo_articulo, nombre, precio_venta, stock, codigo_tipo, estado, presentacion)
                        VALUES (:p_codigo_articulo, :p_nombre, :p_precio_venta, :p_stock, :p_codigo_tipo, :p_estado, :p_presentacion);";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codigo_articulo",$this->getCodigoArticulo());
                    $sentencia->bindParam(":p_nombre",$this->getNombre());               
                    $sentencia->bindParam(":p_precio_venta",$this->getPrecioVenta());               
                    $sentencia->bindParam(":p_stock",$this->getStock());               
                    $sentencia->bindParam(":p_codigo_tipo",$this->getCodigoTipo());               
                    $sentencia->bindParam(":p_estado",$this->getEstado());               
                    $sentencia->bindParam(":p_presentacion",$this->getPresentacion());               
                    $sentencia->execute();

                    $sql = "update correlativo set numero = numero + 1 where tabla = 'articulo'";
                    $sentenciaCO = $this->dblink->prepare($sql);
                    $sentenciaCO->execute();
                    
                    if ($this->getFoto() != null){
                        $this->cargarFoto($this->getFoto(), $this->getCodigoArticulo());
                    }
                   $this->dblink->commit();                          
                }
                
        } catch (Exception $exec) {
            $this->dblink->rollBack();            
            throw $exec;
        }
        return true;
    }
    
    public function cargarFoto($archivoFoto, $idFoto){
       // move_uploaded_file($archivoFoto, "../imagenes/articulos/".$idFoto.".jpg");
        
        if(file_exists("../imagenes/articulos/".$idFoto.".jpg")) { 
           
            if(unlink("../imagenes/articulos/".$idFoto.".png") && file_exists("../imagenes/articulos/".$idFoto.".jpg")){
                move_uploaded_file($archivoFoto,"../imagenes/articulos/".$idFoto.".jpg"); 
            }else{
                move_uploaded_file($archivoFoto, "../imagenes/articulos/".$idFoto.".jpg");           
            }
        }else{             
            move_uploaded_file($archivoFoto, "../imagenes/articulos/".$idFoto.".jpg"); 	
            //rename ("../imagenes/articulos/".$archivoFoto,"../imagenes/articulos/".$dniUsuario.".jpg" );          
        }
    }
    /*
    public function eliminarFoto($idFoto){        
        unlink("../imagenes/articulos/".$idFoto.".jpg") ;
    }*/
    
    public function editar(){
          $this->dblink->beginTransaction();
        try {
                
                $sql="UPDATE articulo SET nombre= :p_nombre, precio_venta= :p_precio_venta, stock= :p_stock,
                                    codigo_tipo= :p_codigo_tipo, estado= :p_estado, presentacion= :p_presentacion
                      WHERE codigo_articulo= :p_codigo_articulo;";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_codigo_articulo",$this->getCodigoArticulo());
                $sentencia->bindParam(":p_nombre",$this->getNombre());               
                $sentencia->bindParam(":p_precio_venta",$this->getPrecioVenta());               
                $sentencia->bindParam(":p_stock",$this->getStock());               
                $sentencia->bindParam(":p_codigo_tipo",$this->getCodigoTipo());               
                $sentencia->bindParam(":p_estado",$this->getEstado());               
                $sentencia->bindParam(":p_presentacion",$this->getPresentacion());    
                $sentencia->execute();

                if ($this->getFoto() != null){                          
                        $this->cargarFoto($this->getFoto(), $this->getCodigoArticulo());
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
            $sql = "update from articulo set estado='I' where codigo_articulo = :p_codigo_articulo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_articulo", $this->getCodigoArticulo());
            $sentencia->execute();
            //$this->eliminarFoto($this->getCodigoArticulo());
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                select a.codigo_articulo, a.nombre, a.presentacion, a.precio_venta, a.stock,c.descripcion as cat, t.descripcion as tip,
                    a.codigo_tipo,t.codigo_categoria, a.estado
                    from articulo a inner join tipo t on a.codigo_tipo=t.codigo_tipo
                                    inner join categoria c on t.codigo_categoria=c.codigo_categoria 
                WHERE codigo_articulo = :p_codigo_articulo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_articulo", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
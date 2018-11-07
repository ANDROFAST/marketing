<?php

require_once '../negocio/Articulo.clase.php';


parse_str($_POST["p_datos"], $datosFrm);
parse_str($_POST["p_foto"], $datosFrm2);
/*echo $_POST["p_datos"];
echo $_FILES["p_foto"]["tmp_name"];
*/
  /*capturar el nombre de la foto del producto que se va a cargar*/
    if (isset($_FILES["p_foto"])){
        $foto = $_FILES["p_foto"]["tmp_name"];
    }else{
        $foto = null;
    }
    /*capturar el nombre de la foto del producto que se va a cargar*/
    
$objCargo = new Articulo();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoArticulo($datosFrm["txtcodigo"]);
}
$objCargo->setNombre($datosFrm["txtnombre"]);
$objCargo->setPresentacion($datosFrm["txtpresentacion"]);
$objCargo->setPrecioVenta($datosFrm["txtprecio"]);
$objCargo->setStock($datosFrm["txtstock"]);
$objCargo->setCodigoTipo($datosFrm["txttipo"]);
$objCargo->setEstado($datosFrm["txtestado"]);
$objCargo->setFoto($foto);;
try {
      
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objCargo->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objCargo->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
    
    
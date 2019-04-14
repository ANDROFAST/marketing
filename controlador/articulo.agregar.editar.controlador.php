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
    
$objProvincia = new Articulo();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProvincia->setCodigoArticulo($datosFrm["txtcodigo"]);
}
$objProvincia->setNombre($datosFrm["txtnombre"]);
$objProvincia->setPresentacion($datosFrm["txtpresentacion"]);
$objProvincia->setPrecioVenta($datosFrm["txtprecio"]);
$objProvincia->setStock($datosFrm["txtstock"]);
$objProvincia->setCodigoTipo($datosFrm["txttipo"]);
$objProvincia->setEstado($datosFrm["txtestado"]);
$objProvincia->setFoto($foto);;
try {
      
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objProvincia->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objProvincia->editar()==true){
            echo "exito";  
      }
    }    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
    
    
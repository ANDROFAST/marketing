<?php
require_once '../negocio/Personal.clase.php';

parse_str($_POST["p_datos_formulario"], $datosFrm);

$objPersonal = new Personal();

$objPersonal->setDniPersonal($datosFrm["txtdni_personal"]);
$objPersonal->setApellidoPaterno($datosFrm["txtapellido_paterno"]);
$objPersonal->setApellidoMaterno($datosFrm["txtapellido_materno"]);
$objPersonal->setNombres($datosFrm["txtnombres"]);
$objPersonal->setDireccion($datosFrm["txtdireccion"]);

if($datosFrm["txttelefono_fijo"]==""){
    $objPersonal->setTelefonoFijo(null);} //mandar valor null
else{
    $objPersonal->setTelefonoFijo($datosFrm["txttelefono_fijo"]);
};

if($datosFrm["txttelefono_movil1"]==""){
    $objPersonal->setTelefonoMovil1(null);} //mandar valor null
else{
    $objPersonal->setTelefonoMovil1($datosFrm["txttelefono_movil1"]);
};

if($datosFrm["txttelefono_movil2"]==""){
    $objPersonal->setTelefonoMovil2(null);} //mandar valor null
else{
    $objPersonal->setTelefonoMovil2($datosFrm["txttelefono_movil2"]);
};

if($datosFrm["txtemail"]==""){
    $objPersonal->setEmail(null);} //mandar valor null
else{
    $objPersonal->setEmail($datosFrm["txtemail"]);
};

if($datosFrm["txtjefe"]==""){
    $objPersonal->setDniJefe(null);} //mandar valor null
else{
    $objPersonal->setDniJefe($datosFrm["txtjefe"]);
};

$objPersonal->setEstadoPersonal($datosFrm["txtestado_personal"]);
$objPersonal->setCodigoCargo($datosFrm["txtcodigo_cargo"]);
$objPersonal->setCodigoArea($datosFrm["txtcodigo_area"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objPersonal->agregar()==true){
            echo "exito";
        }
    }else{
      if ($objPersonal->editar()==true){
            echo "exito";  
      }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
<?php

require_once '../negocio/Cliente.clase.php';
require_once '../negocio/TipoCliente.clase.php';

require_once '../util/funciones/Funciones.clase.php';


$accion = isset($_GET['action']) ? $_GET['action'] : 0;

switch ($accion) {
    case 0: {
            salir();
        } break;
    //Opción: Listar 
    case 1: {

            try {
                $objCliente = new Cliente();
                $resultado = $objCliente->listar();
                tablaListar($resultado);
            } catch (Exception $ex) {
                header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        }break;

    //Opción: TipoPersonal Combo

    case 2: {
            try {
                $objCliente = new TipoCliente();
                $resultado = $objCliente->listar();
                cargarComboCliente($resultado);
            } catch (Exception $ex) {
                header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;

    case 3: {

            parse_str($_POST["p_arrayagregar"], $datosForm);
            
            $estado = isset($datosForm['opcion_estado']) ? $datosForm['opcion_estado'] : 'A';
            $condicion=  isset($datosForm['condiciones']) ? $datosForm['condiciones'] : '1';
          
            $objCliente = new Cliente();
            $clave = md5($datosForm['txtclave']);
            $objCliente->setClave($clave);
            $dni= isset($datosForm['txtdni']) ? $datosForm['txtdni'] : null;
            $objCliente->setDni($dni);                               
            $ruc= isset($datosForm['txtruc']) ? $datosForm['txtruc'] : null;
            $objCliente->setRuc($ruc);            
            $apepat= isset($datosForm['txtapepaterno']) ? $datosForm['txtapepaterno'] : null;
            $objCliente->setApellidoPaterno(strtoupper($apepat));
            $apemat= isset($datosForm['txtapematerno']) ? $datosForm['txtapematerno'] : null;
            $objCliente->setApellidoMaterno(strtoupper($apemat));
            $nom= isset($datosForm['txtnombres']) ? $datosForm['txtnombres'] : null;
            $objCliente->setNombres(strtoupper($nom));
            $rs= isset($datosForm['txtrazonsocial']) ?  $datosForm['txtrazonsocial'] : null;
            $objCliente->setRazonSocial(strtoupper($rs));
            $em=  $datosForm['txtcorreo']=='' ? null : $datosForm['txtcorreo'] ;
            $objCliente->setEmail($em);           
            $tf=  $datosForm['txttelefonofijo']=='' ? null : $datosForm['txttelefonofijo'];
            $objCliente->setTelefonoFijo($tf);
            $tm=  $datosForm['txttelefonomovil']=='' ?  null : $datosForm['txttelefonomovil'] ;
            $objCliente->setTelefonoMovil($tm);
            $dir= $datosForm['txtdireccion']='' ? null : $datosForm['txtdireccion'];
            $objCliente->setDireccion($dir);            
            $dirw=  $datosForm['txtdireccion_web']=='' ? null: $datosForm['txtdireccion_web'];            
            $objCliente->setDireccionWeb($dirw);            
//            $objCliente->setFechaRegistro($datosForm['txtfecharegistro']);            
            $objCliente->setEstado($estado);
            $objCliente->setTerCondicion($condicion);
            $objCliente->setCodigoTipoCliente($datosForm['opcion_cliente']);
            $objCliente->setCodigoDepartamento( $datosForm["cbodepartamentoamodal"] );
            $objCliente->setCodigoProvincia( $datosForm["cboprovinciamodal"] );
            $objCliente->setCodigoDistrito( $datosForm["cbodistritomodal"] );

            try {

                echo $objCliente->agregar() ? 'true' : 'false';
                $resultado = $objCliente->getClientePorCodigo();
                echo json_encode($resultado);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            } 
        } break;

    //obtener datos para modificar
    case 4: {

            $codigo = $_POST['p_codigo'];
            $objCliente = new Cliente();
            $objCliente->setCodigoCliente($codigo);

            try {
                
                $resultado = $objCliente->getClientePorCodigo();

                echo json_encode($resultado);
            } catch (Exception $ex) {
                header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;

    case 5: {
            $codigo = $_POST["p_codigo_cliente"];
            $objCliente = new Cliente();
            try {
                $objCliente->setCodigoCliente($codigo);
                echo $objCliente->eliminar() ? 'true' : 'false';
            } catch (Exception $ex) {
                header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;

    case 6: {

            parse_str($_POST["p_array"], $datosForm);

            $objCliente = new Cliente();
            
            $clave = ($datosForm['txtclave1']) ? md5($datosForm['txtclave1']) : null;
            $cambiarClave = $clave ? true : false;
            
            $dni= isset($datosForm['txtdni1']) ? $datosForm['txtdni1'] : null;
            $objCliente->setDni($dni);                               
            
            $apepat= isset($datosForm['txtapepaterno1']) ? $datosForm['txtapepaterno1'] : null;
            $objCliente->setApellidoPaterno(strtoupper($apepat));
            $apemat= isset($datosForm['txtapematerno1']) ? $datosForm['txtapematerno1'] : null;
            $objCliente->setApellidoMaterno(strtoupper($apemat));
            $nom= isset($datosForm['txtnombres1']) ? $datosForm['txtnombres1'] : null;
            $objCliente->setNombres(strtoupper($nom));
            
            $em=  $datosForm['txtcorreo1']=='' ? null : $datosForm['txtcorreo1'] ;
            $objCliente->setEmail($em);           
            $tf=  $datosForm['txttelefonofijo1']=='' ? null : $datosForm['txttelefonofijo1'];
            $objCliente->setTelefonoFijo($tf);
            $tm=  $datosForm['txttelefonomovil1']=='' ?  null : $datosForm['txttelefonomovil1'] ;
            $objCliente->setTelefonoMovil($tm);
            
            $dir= $datosForm['txtdireccion1']='' ? null : $datosForm['txtdireccion1'];
            $objCliente->setDireccion($dir);            
            $objCliente->setClave($clave);
            $objCliente->setFechaRegistro($datosForm['txtfecharegistro1']);            
            $objCliente->setEstado($datosForm['opcion_estado1']);
                        
            $objCliente->setCodigoDepartamento( $datosForm["cbodepartamentoamodal1"] );
            $objCliente->setCodigoProvincia( $datosForm["cboprovinciamodal1"] );
            $objCliente->setCodigoDistrito( $datosForm["cbodistritomodal1"] );
            
            

            try {

                $objCliente->setCodigoCliente($datosForm['txtcodigo1']);
                echo $objCliente->modificarCliNatural($cambiarClave) ? 'true' : 'false';
            } catch (Exception $ex) {
//                    header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;

    case 7: {

            parse_str($_POST["p_array"], $datosForm);

            $clave = ($datosForm['txtclave2']) ? md5($datosForm['txtclave2']) : null;
            $cambiarClave = $clave ? true : false;
            $objCliente = new Cliente();
            
            $ruc= isset($datosForm['txtrucc']) ? $datosForm['txtrucc'] : null;
            $objCliente->setRuc($ruc);            
            $rs= isset($datosForm['txtrazonsocial2']) ?  $datosForm['txtrazonsocial2'] : null;
            $objCliente->setRazonSocial(strtoupper($rs));
            $em=  $datosForm['txtcorreo2']=='' ? null : $datosForm['txtcorreo2'] ;
            $objCliente->setEmail($em);           
            $tf=  $datosForm['txttelefonofijo2']=='' ? null : $datosForm['txttelefonofijo2'];
            $objCliente->setTelefonoFijo($tf);
            $tm=  $datosForm['txttelefonomovil2']=='' ?  null : $datosForm['txttelefonomovil2'] ;
            $objCliente->setTelefonoMovil($tm);
            $dir= $datosForm['txtdireccion2']='' ? null : $datosForm['txtdireccion2'];
            $objCliente->setDireccion($dir);            
            
            $dirw=  $datosForm['txtdireccion_web2']=='' ? null: $datosForm['txtdireccion_web2'];            
            $objCliente->setDireccionWeb($dirw);            
            
            $objCliente->setFechaRegistro($datosForm['txtfecharegistro2']);  
            $objCliente->setClave($clave);
            $objCliente->setEstado($datosForm['opcion_estado2']);    

            $objCliente->setCodigoDepartamento( $datosForm["cbodepartamentoamodal2"] );
            $objCliente->setCodigoProvincia( $datosForm["cboprovinciamodal2"] );
            $objCliente->setCodigoDistrito( $datosForm["cbodistritomodal2"] );

            
            try {

                $objCliente->setCodigoCliente($datosForm['txtcodigo2']);
                echo $objCliente->modificarCliJuridico($cambiarClave) ? 'true' : 'false';
            } catch (Exception $ex) {
//                    header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;

    case 8: {
            try {
                $objCliente = new TipoCliente();
                $resultado = $objCliente->getTipoCliente();
                cargarComboClientereporte($resultado);
            } catch (Exception $ex) {
                header('HTTP/1.1 500');
                echo $ex->getMessage();
            }
        } break;
}

//    
//   switch ($objCliente->agregar()){
//       case -1:
//           echo 'DNIEXISTENTE';
//           break;
//       case -2:
//           echo 'RUCEXISTENTE';
//           break;
//   }

function tablaListar($resultado) {
    $cabecera = "<tr>
                    <th>CÓDIGO</th>
                    <th>N° DOCUMENTO</th>
                    <th>CLIENTE</th>
                    <th>EMAIL</th>
                    <th>TELÉFONO FIJO</th>
                    <th>TELÉFONO MÓVIL</th>
                    <th>DIRECCIÓN</th>
                    <th>DIRECCIÓN WEB</th>
                    <th>FECHA REGISTRO</th>                   
                    <th>TIPO DE CLIENTE</th>
                    <th>UBIGEO</th>
                    <th>ESTADO</th>
                    <th style='text-align: center'>OPCIÓN</th>
                    </tr>
                ";

    echo '<table id="tabla-listado" class="display table table-bordered">';
    echo '<thead>' . $cabecera . '</thead>';
    echo '<tbody>';
    for ($i = 0; $i < count($resultado); $i++) {
        $codigoParam = "{$resultado[$i]['codigo_cliente']}";
        $estado = ($resultado[$i]['estado'] == 'A') ? 'ACTIVO' : 'INACTIVO';
        $tipoCliente = "{$resultado[$i]['descripcion']}";
        
        if($estado=='ACTIVO'){
            echo '<tr>';
        }else{
            echo '<tr  style="text-decoration:line-through; color:red">';
        }
        echo '<td>' . $resultado[$i]['codigo_cliente'] . '</td>';
        echo '<td>' . $resultado[$i]['ndocumento'] . '</td>';
        echo '<td>' . $resultado[$i]['cliente'] . '</td>';
        echo '<td>' . $resultado[$i]['email'] . '</td>';
        echo '<td>' . $resultado[$i]['telefono_fijo'] . '</td>';
        echo '<td>' . $resultado[$i]['telefono_movil'] . '</td>';
        echo '<td>' . $resultado[$i]['direccion'] . '</td>';
        echo '<td>' . $resultado[$i]['direccion_web'] . '</td>';
        echo '<td>' . $resultado[$i]['fecha_registro'] . '</td>';
        echo '<td>' . $resultado[$i]['descripcion'] . '</td>';
        echo '<td>' . $resultado[$i]['ubigeo'] . '</td>';               
        echo '<td>' . $estado . '</td>';
        
        if ($tipoCliente == 'PERSONA NATURAL') {
            echo '<td>
            <a data-toggle="modal" data-target="#editarModal" href="javascript:void();" class="btn btn-warning btn-xs" onclick="editar('.$codigoParam.')"><i class="fa fa-pencil"></i></a>
            <a data-toggle="modal" href="javascript:void();" class="btn btn-danger btn-xs"  onclick="eliminar('.$codigoParam.')"><i class="fa fa-close"></i></a>
            ' . '</td>';
        } else {
            echo '<td>
            <a data-toggle="modal" data-target="#editarJuridicoModal" href="javascript:void();"  class="btn btn-warning btn-xs"onclick="editarJ('.$codigoParam.')"><i class="fa fa-pencil"></i></a>
            <a data-toggle="modal" href="javascript:void();" class="btn btn-danger btn-xs" onclick="eliminar('.$codigoParam.')"><i class="fa fa-close"></i></a>
            ' . '</td>';
        }

        echo '</tr>';
    }
    echo '</tbody>';
    echo '<tfoot>' . $cabecera . '</tfoot>';
    echo '</table>';
}

function cargarComboCliente($resultado) {
    echo '<option value="0">Todos los clientes</option>';
    for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_tipocliente"].'">' . $resultado[$i]["descripcion"] . '</option>';
    }
}

function cargarComboClientereporte($resultado) {
    echo '<option value="0">Todos los clientes</option>';
    for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="' . $resultado[$i]["codtipocliente"] . '">' . $resultado[$i]["descripcion"] . '</option>';
    }
}

function salir() {
    echo "Hubo un error al procesar tu registro.";
    exit();
}

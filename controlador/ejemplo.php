<?php
require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigo"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $codigocliente = $_POST['p_codigo'];
    
    $obj = new Venta();
    $resultado=$obj->listarVentasPorClienteRanking($codigocliente);

   function groupArray($array,$groupkey)
{
	if (count($array)>0)
	{
		$keys = array_keys($array[0]);
		$removekey = array_search($groupkey, $keys);

		if ($removekey===false)
			return array("Clave \"$groupkey\" no existe");
		else
			unset($keys[$removekey]);

		$groupcriteria = array();
		$return=array();

		foreach($array as $value)
		{
			$item=null;
			foreach ($keys as $key)
			{
				$item[$key] = $value[$key];
			}

			$busca = array_search($value[$groupkey], $groupcriteria);
			if ($busca === false)
			{
				$groupcriteria[]=$value[$groupkey];
				$return[]=array($groupkey=>$value[$groupkey],'groupeddata'=>array());
				$busca=count($return)-1;
			}
			$return[$busca]['groupeddata'][]=$item;
		}
		return $return;
	}
	else
		return array();

}
   
            
  function saveAssociationRules($filename){   
    $contenido='';
    $codigocliente = $_POST['p_codigo'];
     $obj = new Venta();
    $resultado=$obj->listarVentasPorClienteRanking($codigocliente);
     $resultadoAgrupado=groupArray($resultado,'numero_venta');
    
    for ($i2 = 0; $i2 < count($resultadoAgrupado); $i2++) {
        $re='';
        
      //  $resultadoAgrupado2= array($resultadoAgrupado[$i2]["groupeddata"]);
        for ($i3 = 0; $i3 < count($resultadoAgrupado[$i2]["groupeddata"]); $i3++) {
       
        //echo $resultadoAgrupado[$i2]["groupeddata"][$i3]["codigo_articulo"];
        $re.= $resultadoAgrupado[$i2]["groupeddata"][$i3]["articulo_rank"];
         
            if($i3 < count($resultadoAgrupado[$i2]["groupeddata"])){
                //echo ', ';
                $re.= ', ';
                 
            }        
                    
        }
        //echo '<br>';
         $contenido .= "$re \n"; 
    }
    //file_put_contents("DatosTransaccionesArtClientes.txt", $contenido);
    file_put_contents($filename, $contenido);
    return true;
}  
    //echo saveAssociationRules("DatosTransaccionesArtClientes.txt");
    if(saveAssociationRules("../conocimiento/DatosTransaccionesArtClientes.txt")){
        echo "exito";        
    }    
        
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

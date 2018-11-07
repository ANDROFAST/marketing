<?php
include_once '../negocio/class.apriori.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_GET["p_sm"]) || ! isset($_GET["p_confi"]) || ! isset($_GET["p_maxiter"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $sm = $_GET['p_sm'];
    $confi = $_GET['p_confi'];
    $maxiter = $_GET['p_maxiter'];
    
//    echo $confi;
//    echo $maxiter;
    $Apriori = new Apriori();
    $Apriori->setMaxScan($maxiter);      
    $Apriori->setMinSup($sm);        
    $Apriori->setMinConf($confi);      
    $Apriori->setDelimiter(',');   
    $Apriori->process('../conocimiento/DatosTransaccionesArtClientes.txt');

} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

echo '<h1>Conjunto de artículos frecuentes</h1>';
$Apriori->printFreqItemsets();
echo '<h3>Array del conjunto de artículos frecuentes</h3>';
print_r($Apriori->getFreqItemsets()); 

echo '<h1>Reglas de asociación</h1>';
$Apriori->printAssociationRules();
echo '<h3>Array de las reglas de asociación</h3>';
print_r($Apriori->getAssociationRules()); 

$Apriori->saveFreqItemsets('../conocimiento/freqItemsets.txt');
$Apriori->saveAssociationRules('../conocimiento/associationRules.txt');
  


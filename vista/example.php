<!DOCTYPE HTML>
<html>
<head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<title>Apriori Alghoritm</title>
</head>
<body style="font-family: monospace;">
<?php   
include_once '../negocio/class.apriori.php';
$Apriori = new Apriori();
$Apriori->setMaxScan(20);       //Scan 2, 3, ...
$Apriori->setMinSup(3);         //Minimum support 1, 2, 3, ...
$Apriori->setMinConf(50);       //Minimum confidence - Percent 1, 2, ..., 100
$Apriori->setDelimiter(',');    //Delimiter 

$Apriori->process('DatosTransaccionesArtClientes.txt');
//Frequent Itemsets
echo '<h1>Conjunto de artículos frecuentes</h1>';
$Apriori->printFreqItemsets();
echo '<h3>Array del conjunto de artículos frecuentes</h3>';
print_r($Apriori->getFreqItemsets()); 
//Association Rules
echo '<h1>Reglas de asociación</h1>';
$Apriori->printAssociationRules();
echo '<h3>Array de las reglas de asociación</h3>';
print_r($Apriori->getAssociationRules()); 
//Save to file
$Apriori->saveFreqItemsets('freqItemsets.txt');
$Apriori->saveAssociationRules('associationRules.txt');
?>  
</body>
</html>
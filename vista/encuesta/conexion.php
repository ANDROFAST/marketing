<?php // datos para la conexion a mysql
$user = 'postgres';
$passwd = '12345';
$db = 'Tesis2';
$port = 5432;
$host = 'localhost';
$strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd";
$cnx = pg_connect($strCnx) or die ("Error de conexion. ". pg_last_error());
<?php

$host="avilldb.ceenrslgtl8b.us-east-2.rds.amazonaws.com";
$user="kjvqxxdyioocpd";	
$pass="1ecfa73d2788743c43ddba2afff01f39cac73a5b50d259819252a1408ca5dcd1";	
$dbname="d4ppp5t71v3odv";
$port=5432;
$conexion = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

/*if($conexion)
echo "<br>conectado";
else
echo "<br>No conectado";*/
?>
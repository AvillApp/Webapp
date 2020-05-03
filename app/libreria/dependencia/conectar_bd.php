<?php
$hostname_conectar_bd = "ec2-50-17-90-177.compute-1.amazonaws.com";
$database_conectar_bd =  'd4ppp5t71v3odv'; // Base de datos de la instituci贸n
$username_conectar_bd =  'kjvqxxdyioocpd'; // Usuario de la base de datos de la instituci贸n 
$password_conectar_bd =  '1ecfa73d2788743c43ddba2afff01f39cac73a5b50d259819252a1408ca5dcd1'; // Clave de la base de datos de la instituci贸n.
$conectar_bd = mysqli_connect($hostname_conectar_bd, $username_conectar_bd, $password_conectar_bd, $database_conectar_bd ); 
if($conectar_bd)
echo "<br>conectado";
else
echo "<br>No conectado";
?>
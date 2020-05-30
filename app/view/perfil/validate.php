<?php 
@session_start();

@include('../../config.php');

$sql2 = "select pedidos.vehiculo_usu, pedidos.emision, pedidos.id, pedidos.latitude, pedidos.longitude, estado.id as idestado, pedidos.fecha_update, pedidos.telealt, pedidos.id_user,
 pedidos.indicacion, pedidos.direccion, users.nombre, pedidos.fecha_registro, estado.descripcion as estado, users.telefono
 from pedidos, users,estado where estado.id=pedidos.estado and users.id=pedidos.id_user and pedidos.estado!=6 order by pedidos.id desc";
$query2 = pg_query($conexion, $sql2);
$rows2 = pg_num_rows($query2);

//$_SESSION['solic'];
if($rows2>$_SESSION['solic'])
    echo "1";

?>
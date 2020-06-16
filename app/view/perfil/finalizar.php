<?php 
include('../../routers/rutas.php'); // Rutas
@include('../../config.php');
include('../../../vendor/push.php');

// consultamos para mostrar solo los conductores disponibles
 $sql ="update pedidos set estado=6 where id='".$_GET['id_pedido']."' ";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
   

$titulo="Viaje finalizado";
$descripcion="Gracias por preferirnos";

 $sql2="insert into logs_pedidos (id_pedido, description, time, fecha, created_by, title)
    values('".$_GET['id_pedido']."', '".$descripcion."', '".$hora."', '".$fecha."', '".$_SESSION['id_user']."', '".$titulo."') ";
    $query2 = pg_query($conexion, $sql2);
    
 $sql3 ="select id_conductor from pedidos_condu where id_pedido='".$_GET['id_pedido']."' ";
 $query3 = pg_query($conexion, $sql3);
 $rows3 = pg_num_rows($query3);
 
 if($rows3){
   $datos4 = pg_fetch_assoc($query3);
    $sql4 ="update pedidos_condu set estado=6 where id='".$_GET['id_pedido']."' ";
    $query4 = pg_query($conexion, $sql4);
    
    $sql5 ="update users set estado=1 where id='".$datos4['id_conductor']."' ";
    $query5 = pg_query($conexion, $sql5);

    // Enviamos notificación al usuario.
    $title="Viaje finalizado";
    $msg = "Gracias por utilizar el servicio";              
    $userId = "1"; // Prueba;
    enviar_push(base64_decode($_GET['token']), $msg, $title, $userId);
 }
 

 
 // Buscamos el codductor de ese pedido
 
    
echo "PEDIDO FINALIZADO CORRECTAMENTE";

?>

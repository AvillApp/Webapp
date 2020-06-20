<?php 
include('../../routers/rutas.php'); // Rutas
@include('../../config.php');
include('../../../vendor/push.php');
function envio_sms($tel, $mensaje, $refer){
        
   // echo "entro aacá en mensajes";
       // echo $tel;
            $timepoinicio = microtime(true);

                                                unset($ch);
                                                unset($peticion_envio_mensajes_json);
                                                
                                            
                                                    $mensaje =  $mensaje;
                                                    $cliente = '10011364';
                                                    $apikey = 'OZW8Pp1OgaRLUrDzBxqS246kE2EopU';
                                                    $numeros = $tel;
                                                    $texto = $mensaje;
                                                    $referencia = $refer;
                                                    $fecha_programacion = '';

                                                    $arrayName = array(
                                                        'cliente' => $cliente,
                                                        'api' => $apikey,
                                                        'numero' => $numeros,
                                                        'sms' => $texto,
                                                        'fecha' => $fecha_programacion,
                                                        'referecia' => $referencia
                                                    );

                                                    $url_pubsub_string ='https://api.hablame.co/sms/envio/';
                                                    // abrimos la sesión cURL
                                                    $ch = curl_init();
                                                    // definimos la URL a la que hacemos la petición
                                                    curl_setopt($ch, CURLOPT_URL, $url_pubsub_string);
                                                    // indicamos el tipo de petición: POST
                                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                                    // definimos cada uno de los parámetros
                                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayName);

                                                    // recibimos la respuesta y la guardamos en una variable
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                    $remote_server_output = curl_exec ($ch);
                                                    // cerramos la sesión cURL
                                                    curl_close ($ch);
                                                    // hacemos lo que queramos con los datos recibidos
                                                    // por ejemplo, los mostramos
                                                    //  print_r($remote_server_output);
                                                    //print($remote_server_output);
                                                    //  var_dump($remote_server_output);
                                                    $timpofin = microtime(true);
                                                    //print ('el tiempo total: '.($timpofin-$timepoinicio));

    
}

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
    
    envio_sms($base64_decode($_GET['tel_usu']), $msg, $title);
      //NO enviar push todavía
   // enviar_push(base64_decode($_GET['token']), $msg, $title, $userId);
 }
 

 
 // Buscamos el codductor de ese pedido
 
    
echo "PEDIDO FINALIZADO CORRECTAMENTE";
?>
<script>
location.reload();
</script>

<?php
include('../../vendor/push.php'); // Enviar notificaciones push

function validate($id, $direccion){  // Validar pedido del usuario
    @include('../config.php');

 $sql = "select id from pedidos where id_user='".$id."' and direccion='".trim(strtoupper($direccion))."' and estado = 1";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
    if($rows)
        return "1";
    else
        return "2";

}
  
function idPedido ($id, $direccion){ // Id PEDIDO
    @include('../config.php');

    $sql = "select max(id) as id from pedidos where id_user='".$id."' and estado = 3";
    //$sql = "select max(id) as id from pedidos where id_user='".$id."' and direccion='".trim(strtoupper($direccion))."' and estado = 3";
    $query = pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
       if($rows){
           $datos =pg_fetch_assoc($query);
           return $datos['id'];
       }
       else
           return "error";
}

function logs_pedidos($id, $titulo, $descripcion, $hora, $fecha, $created_by){
    @include('../config.php');

    $sql="insert into logs_pedidos (id_pedido, description, time, fecha, created_by, title)
    values('".$id."', '".$descripcion."', '".$hora."', '".$fecha."', '".$created_by."', '".$titulo."') ";
    $query = pg_query($conexion, $sql);
        if($query){
            $datos2 = array(
                'estado' => 'exito',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }
}

function save($id, $direccion, $indicacion, $longitude, $latitude, $estado, $telealt, $register_by, $emision, $vehiculo, $token){

    @include('../config.php');
    $validate = validate($id, $direccion);
    if($validate==2){

        if($telealt=='')
        $telealt=0;
        
        $insert = "insert into pedidos (id_user, direccion, indicacion, longitude, latitude, estado, 
        telealt, register_by, fecha_registro, emision, vehiculo_usu, token) values('".$id."', '".strtoupper($direccion)."', '".$indicacion."', 
        '".$longitude."', '".$latitude."', '".$estado."', '".$telealt."', '".$register_by."', '".$fecha_registro."', '".$emision."', '".$vehiculo."', '".$token."') ";
        $query = pg_query($conexion,$insert);

            if($query){
                // Registamos el evento del pedido del usuario
                $info =  idPedido ($id, $direccion);
                    if($info!='error'){
                        $titulo= 'Solicitud de Vehículo Seguro';
                        logs_pedidos($info , $titulo, 'Haz solicitado un vehículo seguro', $hora, $fecha, $register_by);
                    }

                $datos2 = array(
                    'estado' => 'exito',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }else{
                $datos2 = array(
                    'estado' => 'error interno',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }

    }else{
        $datos2 = array(
            'estado' => 'Pedido ya existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }

}
function update_estad_pd($id, $estado){
    @include('../config.php');

    $update = "update pedidos set estado='".$estado."', fecha_update='".$fecha_registro."' where id='".$id."' ";
    $query = pg_query($conexion, $update);
        if($query){
            return "1";
        }
        else    
            return "error";
}

function update_estad_cond($id, $estado){
    @include('../config.php');
    $update = "update users set estado='".$estado."' where id='".$id."' ";
    $query = pg_query($conexion, $update);
    $rows = pg_num_rows($query);

        if($rows){
             $datos2 = array(
                    'estado' => 'exito',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
        }
        else{    
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }
}

function infoConductor($conductor){
    @include('../config.php');
    $sql = "select vehiculo.placa, users.foto, users.telefono, users.nombre, users.apellidos from vehiculo, user_vehiculo, users
    where users.id=user_vehiculo.id_user and vehiculo.id=user_vehiculo.id_vehiculo and user_vehiculo.id_user='".$conductor."' ";
    $query =pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
        if($rows){

            $datos = pg_fetch_assoc($query);
            $conductor = $datos['nombre']." ".$datos['apellidos'];
            return $datos['placa'].",".$datos['telefono'].",".$datos['foto'].",".$conductor;
        }
}

function envio_sms($tel, $mensaje, $refer){
        
    //echo "entro aacá en mensajes";
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
function select_conduct($id, $conductor, $estado, $created_by, $tiempo, $precio, $tel_usu){
    @include('../config.php');
    
    $sql = "select id from pedidos_condu where id_pedido='".$id."' ";
    $query = pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
    
        if($rows){
            $sql2 = "update pedidos_condu set id_conductor='".$conductor."', estado='".$estado."', update_by='".$created_by."', 
            fecha_update='".$fecha_registro."' where id_pedido='".$id."'  ";
        }else{
            $sql2 ="insert into pedidos_condu (id_pedido, id_conductor, estado, created_by, fecha_registro)
            values('".$id."', '".$conductor."','".$estado."', '".$created_by."', '".$fecha_registro."') ";
        }
        $query2 = pg_query($conexion, $sql2);
        //$rows = pg_affected_rows($query2);
            if($query2){
                $placa = infoConductor($conductor);
                $placa = explode(",", $placa);

                $mensaje = "Encontramos un conductor, placa: # $placa[0] precio: $".number_format($precio);
                $titulo = "Conductor disponible";
                logs_pedidos($id ,$titulo, $mensaje, $hora, $fecha, $created_by); // Registramos los logs del pedido
                update_estad_pd($id, $estado); // Cambiamos estado del pedido
                update_estad_cond($conductor, $estado); // Cambiamos estado del conductor
                
                // Enviamos notificacion push, 

                $title="Tu Rapi Segura";
                $msg = "Hemos encontrado un conductor, confirma el viaje";              
                $userId = "1"; // Prueba;
                //"No enviar push";

              //  enviar_push($token, $msg, $title, $userId);

                // Actualimzamos el precio del pedido

                $q = "update pedidos set precio='".$precio."', tiempo='".$tiempo."' where id='".$id."' ";
                $q1 = pg_query($conexion, $q);

                $datos2 = array(
                    'estado' => 'exito',  
                    'placa' => $placa,
                    'precio' => $precio
                                    
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }else{
                $datos2 = array(
                    'estado' => 'error',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }

}

function getlogs_pedidos($id){    
      @include('../config.php');

      $sql = "select time, title, description  from logs_pedidos where id_pedido='".$id."' order by time ";
      $query = pg_query($conexion, $sql);
      $rows = pg_num_rows($query);
        if($rows){

            $rawdata = array(); //creamos un array
                $i=0;
                while ($datos = pg_fetch_array($query)){
                    $rawdata[$i] = $datos;
                    $i++;         
                }
                header('Content-Type: application/json');
                return json_encode($rawdata);  

        }else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }
}

function info_estado($id){
    @include('../config.php');

    $sql = "select pedidos.estado, pedidos.precio, pedidos_condu.id_conductor, pedidos.tiempo
     from pedidos, pedidos_condu 
     where pedidos_condu.id_pedido=pedidos.id 
     and pedidos.id='".$id."' ";
    $query = pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
    
        if($rows){
            $datos = pg_fetch_assoc($query);

           $info =  infoConductor($datos['id_conductor']);
           $info = explode(",", $info);

            $foto = 'https://intranet.avill.com.co/files/'.$info[2];
            $placa =  $info[0];
            $telefono = $info[1];
            $conductor = $info[3];
            $tiempo = $datos['tiempo']." minutos";
            $datos2 = array(
                'estado' => 'exito',
                'pedido' => $datos['estado'],  
                'precio' => $datos['precio'],
                'placa' => $placa,
                'conductor' =>$conductor,
                'tiempo' => $tiempo,
                'foto' => $foto          
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
            
        }else{           
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }
}



function confirmar_pedido($id, $estado, $id_user){
    @include('../config.php');
    //echo $user;
    $confirmar = update_estad_pd($id, $estado);

    if($confirmar==1){
        // Registramos el log del pedido.

        $mensaje = "Haz confirmado tu vehículo seguro";
        $titulo = "Viaje confirmado";
        logs_pedidos($id ,$titulo, $mensaje, $hora, $fecha, $id_user); // Registramos los logs del pedido
        return "1";

    }else{
        return "error";
    }
}

function cancelar_pedido($id, $estado, $id_user){
    @include('../config.php');
   // echo $user;
    $confirmar = update_estad_pd($id, $estado);

    if($confirmar==1){
        // Registramos el log del pedido.

        $mensaje = "Haz cancelado tu vehículo seguro";
        $titulo = "Viaje cancelado";
        logs_pedidos($id ,$titulo, $mensaje, $hora, $fecha, $id_user); // Registramos los logs del pedido
        return "1";

    }else{
        return "error";
    }
}


function getViajes($id){    
    @include('../config.php');

    $sql = "select pedidos.id, pedidos.direccion, estado.descripcion as estado 
    from pedidos, estado
    where pedidos.estado=estado.id and pedidos.id_user='".$id."' ";
    $query = pg_query($conexion, $sql);
    $rows = pg_num_rows($query);

      if($rows){
          $rawdata = array(); //creamos un array
              $i=0;
              while ($datos = pg_fetch_array($query)){
                  $rawdata[$i] = $datos;
                  $i++;         
              }
              header('Content-Type: application/json');
              return json_encode($rawdata);  

      }else{
          $datos2 = array(
              'estado' => 'error',                   
          );               
          header('Content-Type: application/json');
          return json_encode($datos2, JSON_FORCE_OBJECT);
      }
}
?>
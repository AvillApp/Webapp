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
                        $titulo= 'Solicitud de Rappi Segura';
                        logs_pedidos($info , $titulo, 'Haz solicitado una rappi segura', $hora, $fecha, $register_by);
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
    $sql = "select vehiculo.placa from vehiculo, user_vehiculo 
    where vehiculo.id=user_vehiculo.id_vehiculo and user_vehiculo.id_user='".$conductor."' ";
    $query =pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
        if($rows){

            $datos = pg_fetch_assoc($query);
            return $datos['placa'];
        }
}
function select_conduct($id, $conductor, $estado, $created_by, $tiempo, $precio, $token){
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
                $mensaje = "Encontramos un conductor, placa: # $placa precio: $".number_format($precio);
                $titulo = "Conductor disponible";
                logs_pedidos($id ,$titulo, $mensaje, $hora, $fecha, $created_by); // Registramos los logs del pedido
                update_estad_pd($id, $estado); // Cambiamos estado del pedido
                update_estad_cond($conductor, $estado); // Cambiamos estado del conductor
                
                // Enviamos notificacion push, 

                $title="Tu Rapi Segura";
                $msg = "Hemos encontrado un conductor, confirma el viaje";              
                $userId = "1"; // Prueba;
                enviar_push($token, $msg, $title, $userId);

                // Actualimzamos el precio del pedido

                $q = "update pedidos set precio='".$precio."' where id='".$id."' ";
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

    $sql = "select estado, precio from pedidos where id='".$id."' ";
    $query = pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
    
        if($rows){
            $datos = pg_fetch_assoc($query);
           
            $datos2 = array(
                'estado' => 'exito',
                'pedido' => $datos['estado'],  
                'precio' => $datos['precio']          
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

        $mensaje = "Haz confirmado la rappi segura";
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

        $mensaje = "Haz cancelado tu rappi segura";
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
<?php


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

function save($id, $direccion, $indicacion, $longitude, $latitude, $estado, $telealt, $register_by){

    @include('../config.php');
    $validate = validate($id, $direccion);
    if($validate==2){

        $insert = "insert into pedidos (id_user, direccion, indicacion, longitude, latitude, estado, 
        telealt, register_by, fecha_registro) values('".$id."', '".strtoupper($direccion)."', '".$indicacion."', 
        '".$longitude."', '".$latitude."', '".$estado."', '".$telealt."', '".$register_by."', '".$fecha_registro."') ";
        $query = pg_query($conexion,$insert);

            if($query){
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

function select_conduct($id, $conductor, $estado, $created_by){
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
        $query2 = pg_query($sql2);
        //$rows = pg_affected_rows($query2);
            if($query2){
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
?>
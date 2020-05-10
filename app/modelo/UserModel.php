<?php

include('../modelo/SessionModel.php'); // session

function validate($telefono){
    @include('../config.php');

 $sql = "select id from users where telefono='".$telefono."' ";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
    if($rows)
        return "1";
    else
        return "2";

}

function save($nombre, $apellidos, $telefono, $tipouser){
    @include('../config.php');
    $validate = validate($telefono);
    if($validate == 2){
        $insert = "insert into users (nombre, apellidos, telefono, tipouser, fecha_registro, estado)
         values('".$nombre."', '".$apellidos."', '".$telefono."', '".$tipouser."', '".$fecha_registro."', 1) ";
        $query = pg_query($conexion, $insert);
        
            if($query){
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
    }else{
        
        $datos2 = array(
            'estado' => 'Usuario ya existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
       
    }
}

function update($id, $nombre, $apellidos, $telefono, $email, $id_usuario, $tipouser, $estado){
    @include('../config.php');
    $validate = validate($telefono);

    if ($validate == 1){

        $update = "update users set nombre='".$nombre."', email='".$email."',
         id_usuario='".$id_usuario."', tipouser='".$tipouser."' where id='".$id."' ";
        @$query = pg_query($conexion, $update);
            if($query){
                $datos2 = array(
                    'estado' => 'exito',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }
            else{
                $datos2 = array(
                    'estado' => 'Teléfono ya existe',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT); 
            }
    }else{
        $datos2 = array(
            'estado' => 'Usuario no existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
       // return "3";
    }

}

function elim($id, $telefono){
    @include('../config.php');
    $validate = validate($telefono);

    if ($validate == 1){

         $update = "update users set estado = 2 where id='".$id."' and telefono='".$telefono."' ";
         $query = pg_query($conexion, $update);
         $rows = pg_affected_rows($query);
            if($rows>0){
                $datos2 = array(
                    'estado' => 'exito',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }
            else{
                $datos2 = array(
                    'estado' => 'Token incorrecto',                   
                );               
                header('Content-Type: application/json');
                return json_encode($datos2, JSON_FORCE_OBJECT);
            }
    }else{
        $datos2 = array(
            'estado' => 'Usuario no existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }
}

function login($telefono){
    $validate = validate($telefono);
    if ($validate == 1){
        $add_sesion=add_session($telefono);
            if($add_sesion==1){
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
    else{
        $datos2 = array(
            'estado' => 'No',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }
}

function logout(){
    $cerrar_sesion = cerrar_sesion ();
    if($cerrar_sesion==1){
        $datos2 = array(
            'estado' => 'exito',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }
}

function infoUser($telefono){
    @include('../config.php');
    $validate = validate($telefono);
    if($validate==1){
        $sql = "select id, nombre, apellidos from users where telefono='".$telefono."' ";
        $query = pg_query($conexion, $sql);
        $rows = pg_num_rows($query);
            if($rows){
                $datos = pg_fetch_assoc($query);
                $datos2 = array(
                    'estado' => 'exito',  
                    'id' => $datos['id'],  
                    'nombre' => $datos['nombre'],  
                    'apellidos' => $datos['apellidos'],                 
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
    }else{
        $datos2 = array(
            'estado' => 'error',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }

}

?>
<?php

include('./SessionModel.php'); // session

function validate_user($telefono){

 $sql = "select * from users where telefono='".$telefono."' ";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($sql);
    if($rows)
        return "1";
    else
        return "2";

}

function save_user($nombre, $telefono){
    $validate = validate_user($telefono);
    if($validate == 2){
        $insert = "insert into users (nombre, telefono, tipouser, fecha_registro)
         values('".$nombre."', '".$telefono."', '".$tipouser."', '".$fecha_registro."') ";
        $query = pg_query($conexion, $insert);
            if($query)
                return "1";
            else
                return "2";
    }
}

function update_user($id, $nombre, $apellidos, $telefono, $email, $id_usuario, $tipouser, $estado){
    $validate = validate_user($telefono);

    if ($validate == 1){

        $update = "update users nombre='".$nombre."', telefono='".$telefono."', email='".$email."',
         telefono='".$telefono."', id_usuario='".$id_usuario."', tipouser='".$tipouser."' ";
        $query = pg_query($conexion, $update);
            if($query)
                return "1";
            else
                return "2";
    }else{
        return "3";
    }

}

function elim_user($id, $telefono){

    $validate = validate_user($telefono);

    if ($validate == 1){

        $update = "update users estado = 2 where id='".$id."' ";
        $query = pg_query($conexion, $update);
            if($query)
                return "1";
            else
                return "2";
    }else{
        return "3";
    }
}

function login_user($telefono){

    $validate = validate_user($telefono);
    if ($validate == 1)
        return "1";
    else
        return "2";
}

function logout_user($id){
    $cerrar_sesion = cerrar_sesion ($id);
}

?>
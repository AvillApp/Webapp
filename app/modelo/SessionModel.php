<?php
function cerrar_sesion (){
    @session_start();
    //if($id == $_SESSION['id'])
     session_destroy();
     return "1";
}

function add_session($id){
    @include('../config.php');

    $sql = "select id, nombre, apellidos from users where telefono='".$id."' ";
    $query =pg_query($conexion, $sql);
    $rows = pg_num_rows($query);
        if($rows){
            $datos = pg_fetch_assoc($query);
            $_SESSION['id'] = $id;
            $_SESSION['id_user'] = $datos['id'];
            $_SESSION['nombre'] = $datos['nombre']." ".$datos['apellidos'];
            return "1";
        }else{
            return "2";
        }
    

   

    /*$sql = "insert into sesion (id_user, id_device, fecha_inicio, fecha_registro) 
    values('".$id_user."', '".$id_device."', '".$fecha_inicio."', '".$fecha_registro."') ";
    $query = pg_query($conexion, $sql);
        if($query){
            $_SESSION['id'] = $id;
            return "1";
        }else
        return "2";   */
}

?>
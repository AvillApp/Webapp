<?php
function cerrar_sesion (){
    @session_start();
    //if($id == $_SESSION['id'])
     session_destroy();
     return "1";
}

function add_session($id){
    @session_start();
    include('../libreria/dependencia/conexion.php');
    $_SESSION['id'] = $id;

    return "1";

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
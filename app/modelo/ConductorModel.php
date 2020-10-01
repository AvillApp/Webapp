<?php 

// function validate_usrveh(){

// }

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

function infoUser($telefono){
    @include('../config.php'); 
   
         $sql = "select id from users where telefono='".$telefono."' ";
        $query = pg_query($conexion, $sql);
        $rows = pg_num_rows($query);
            if($rows){
                $datos = pg_fetch_assoc($query);
                return $datos['id'];
            }else{
               return "error";
            }
}


function save_user($nombre, $apellidos, $telefono, $tipouser, $vehiculo){
    @include('../config.php');
    $validate = validate($telefono);
    if($validate == 2){

       // echo  "valor: ".$_SESSION['archivo'];

        $sq = "select ruta from archivos order by id desc";
        $fg = pg_query($conexion, $sq);
        $rg = pg_num_rows($fg);

            if($rg){
                $df  = pg_fetch_assoc($fg);
                $foto = $df['ruta'];
            }
       $insert = "insert into users (nombre, apellidos, telefono, tipouser, fecha_registro, estado, foto)
         values('".$nombre."', '".$apellidos."', '".$telefono."', '".$tipouser."', '".$fecha_registro."', 1, '".$foto."') ";
        $query = pg_query($conexion, $insert);
        
            if($query){
                @$_SESSION['archivo']="";
               
                $id_user = infoUser($telefono);
                    if($id_user!="error")
                        return $select = select_vehiculo($id_user, $vehiculo);
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

function select_vehiculo($id_user, $vehiculo){
    @include('../config.php');
        $insert = "insert into user_vehiculo (id_user, id_vehiculo, fecha_registro)
         values('".$id_user."', '".$vehiculo."', '".$fecha_registro."') ";
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
}

?>
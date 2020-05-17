<?php 


function validate($placa){  // Validar pedido del usuario
    @include('../config.php');

 $sql = "select id from vehiculo where placa='".trim(strtoupper($placa))."'";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
    if($rows)
        return "1";
    else
        return "2";

}
function save ($nombre, $placa, $modelo, $marca, $vigencia){ // Id PEDIDO
    @include('../config.php');
    $validate = validate($placa);
    if($validate==2){
        
        $insert = "insert into vehiculo (nombre, placa, modelo, marca, vigencia, fecha_registro, created_by) values('".strtoupper($nombre)."', '".strtoupper($placa)."', 
        '".strtoupper($modelo)."', '".strtoupper($marca)."', '".$vigencia."', '".$fecha_registro."','".$_SESSION['id_user']."') ";
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
            'estado' => 'Vehiculo ya existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);
    }
}

function validateId($id){  // Validar pedido del usuario
    @include('../config.php');

 $sql = "select id from vehiculo where id='".trim(strtoupper($id))."'";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
    if($rows)
        return "1";
    else
        return "2";

}

function update($id, $nombre, $placa, $modelo, $marca, $vigencia){
    @include('../config.php');
    $validate = validateId($id);
    if($validate==1){

        $insert = "update vehiculo set nombre='".strtoupper($nombre)."', placa='".strtoupper($placa)."', modelo='".strtoupper($nombre)."',
         marca='".strtoupper($marca)."', vigencia='".strtoupper($vigencia)."',
          fecha_update='".$fecha_registro."', update_by='".$_SESSION['id_user']."' where id='".$id."' ";
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
            'estado' => 'Vehiculo NO existe',                   
        );               
        header('Content-Type: application/json');
        return json_encode($datos2, JSON_FORCE_OBJECT);

    }
}

?>
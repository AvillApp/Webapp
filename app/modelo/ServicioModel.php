<?php 

    function validate_serv($nombre){
        @include('../config.php');
        $sql = "select id from servicio where nombre='".trim($nombre)."' ";
        $query = pg_query($conexion, $sql);
        $rows = pg_num_rows($query);
            if($rows){
                return "1";
            }else
                return "2";
    }
    function validate_tipo($nombre){
        @include('../config.php');

        $sql = "select id from tipo_servicio where nombre='".trim($nombre)."' ";
        $query = pg_query($conexion, $sql);
        $rows = pg_num_rows($query);
            if($rows){
                return "1";
            }else
                return "2";
    }

    function save($nombre){
        @include('../config.php');
        $validate = validate_serv($nombre);
        
        if($validate==2){

            $update = "insert into servicio (nombre, fecha_registro) values('".$nombre."', '".$fecha_registro."') ";
            $query = pg_query($conexion, $update);
            
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
        }else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }

        
    }
    function update($id, $nombre){
        @include('../config.php');

        $validate = validate_serv($nombre);
        
        //if($validate==1){
 
            $update = "update servicio set nombre='".$nombre."' where id='".$id."' ";
            $query = pg_query($conexion, $update);
            
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
       /* }else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }*/

    }
    function save_tipo($id, $nombre){
        @include('../config.php');

        $validate = validate_tipo($nombre);
        
        if($validate==2){

            $update = "insert into tipo_servicio (servicio, nombre, fecha_registro) values('".$id."', '".$nombre."', '".$fecha_registro."') ";
            $query = pg_query($conexion, $update);
            
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
        }else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }
        
    }
    
    function update_tipo($id, $nombre, $estado, $servicio){
        @include('../config.php');

        $validate = validate_tipo($nombre);
        
       // if($validate==1){
 
            $update = "update tipo_servicio set nombre='".$nombre."', servicio='".$servicio."' where id='".$id."' ";
            $query = pg_query($conexion, $update);
            
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
        /*}else{
            $datos2 = array(
                'estado' => 'error',                   
            );               
            header('Content-Type: application/json');
            return json_encode($datos2, JSON_FORCE_OBJECT);
        }*/

    }


    function getServicios(){    
        @include('../config.php');
    
        $sql = "select id, nombre 
        from servicio ";
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

    function getTipo($id){    
        @include('../config.php');
    
        $sql = "select nombre
        from tipo_servicio
        where servicio='".$id."' ";
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
                  return array_encode($rawdata);  
    
          }else{
              $datos2 = array(
                  'estado' => 'error',                   
              );               
              header('Content-Type: application/json');
              return json_encode($datos2, JSON_FORCE_OBJECT);
          }
    }
?>

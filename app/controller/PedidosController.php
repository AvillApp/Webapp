<?php 
@header('Access-Control-Allow-Origin: *');
include('../modelo/PedidosModel.php'); //Modelo de pedidos

if(isset($_POST['pedido'])){ // 
   //echo "Entró aquí";

    if(isset($_POST['save'])){ 

        echo save($_POST['id_user'], $_POST['direccion'], $_POST['indicacion'], 
        $_POST['longitude'], $_POST['latitude'], $_POST['estado'], $_POST['telealt'], $_POST['register_by']);
    }

    if(isset($_POST['update_user'])){ // Actualizar pedido desde del usuario

       echo  update($_POST['id'], $_POST['id_user'], $_POST['direccion'], $_POST['indicacion'], 
       $_POST['longitude'], $_POST['latitude'], $_POST['estado'], $_POST['telealt']);
    }

    if(isset($_POST['update_center'])){ // Actualizamos el precio del pediod y el tiempo

        echo  update($_POST['id'], $_POST['tiempo'], $_POST['precio'], $_POST['estado']);
    }

    if(isset($_POST['select_conduc'])){
        echo  select_conduct($_POST['id'], $_POST['conductor'], $_POST['estado'], $_POST['created_by']);
    } 

    if(isset($_POST['delete'])){
        echo elim($_POST['id'], $_POST['estado']);
    }
    
}

?>
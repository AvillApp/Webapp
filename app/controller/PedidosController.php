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
        echo  select_conduct($_POST['id'], $_POST['conductor'], $_POST['estado'], $_POST['created_by'], $_POST['tiempo'], $_POST['precio'], base64_decode($_POST['token']));
    } 

    if(isset($_POST['delete'])){
        echo update_estad_pd($_POST['id'], $_POST['estado']);
    }

    
    
}


if(isset($_GET['pedido_user'])){ //  Desde el móvil
    //echo "Entró aquí";
 
    if(isset($_GET['save'])){ 
 
         echo save($_GET['id_user'], $_GET['direccion'], $_GET['indicacion'], 
         $_GET['longitude'], $_GET['latitude'], $_GET['estado'], $_GET['telealt'], $_GET['register_by'], $_GET['emision'], $_GET['vehiculo_user'], $_GET['token_push']);
     }
 
    if(isset($_GET['update'])){ // Actualizar pedido desde del usuario
 
        echo update($_GET['id'], $_GET['id_user'], $_GET['direccion'], $_GET['indicacion'], 
        $_GET['longitude'], $_GET['latitude'], $_GET['estado'], $_GET['telealt']);
     }
 
   
    if(isset($_GET['getLog'])){
        echo getlogs_pedidos($_GET['id']);
    }

    if(isset($_GET['IdPedido'])){
        echo idPedido ($_GET['id'], $_GET['direccion']);
    }

    if(isset($_GET['delete'])){       

        echo cancelar_pedido($_GET['id'], $_GET['estado'], $_GET['id_user']);
        //echo update_estad_pd($_GET['id'], $_GET['estado']);
    }
    
    if(isset($_GET['confirmar'])){
        //echo "valor: ".$_GET['id_user'];
        echo confirmar_pedido($_GET['id'], $_GET['estado'], $_GET['id_user']);
       // echo update_estad_pd($_GET['id'], $_GET['estado']);
    }

    if(isset($_GET['info_estado'])){
        echo info_estado($_GET['id']);
    }

    if(isset($_GET['getViajes'])){
        echo getViajes($_GET['id_user']);
    }
     
 }

?>
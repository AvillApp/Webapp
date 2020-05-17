<?php 
@header('Access-Control-Allow-Origin: *');
include('../modelo/VehiculoModel.php'); //Modelo de pedidos

if(isset($_POST['vehiculo'])){ // 
   //echo "Entró aquí";

    if(isset($_POST['save'])){ 

        echo save($_POST['nombre'], $_POST['placa'], $_POST['modelo'], 
        $_POST['marca'], $_POST['vigencia']);
    }

    if(isset($_POST['update'])){ // Actualizar pedido desde del usuario

        echo update($_POST['id'], $_POST['nombre'], $_POST['placa'], $_POST['modelo'], 
        $_POST['marca'], $_POST['vigencia']);
    }

    if(isset($_POST['update_center'])){ // Actualizamos el precio del pediod y el tiempo

        echo  update($_POST['id'], $_POST['tiempo'], $_POST['precio'], $_POST['estado']);
    }

    if(isset($_POST['select_conduc'])){
        echo  select_conduct($_POST['id'], $_POST['conductor'], $_POST['estado'], $_POST['created_by'], $_POST['tiempo'], $_POST['precio']);
    } 

    if(isset($_POST['delete'])){
        echo elim($_POST['id'], $_POST['estado']);
    }
    
}
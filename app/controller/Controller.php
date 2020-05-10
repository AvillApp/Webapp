<?php 
@header('Access-Control-Allow-Origin: *');


include('../modelo/Funciones.php'); //Modelo de usuario

if(isset($_POST['users'])){ // Modelo de usuarios
   // echo "Entró aquí";

    if(isset($_POST['login'])){ // Autenticación de usuario
      // echo "Entró aquí";
        echo login_user($_POST['telefono']);
    }
    
    if(isset($_POST['logout'])){
       // echo logout_user($_POST['id']);
       echo logout_user();
    }

    if(isset($_POST['save'])){ // Guardar usuario

        echo save_user($_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['tipouser']);
    }

    if(isset($_POST['update'])){

       echo  update_user($_POST['id'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['email'], $_POST['id_usuario'], 
       $_POST['tipouser'], $_POST['estado']);
    }
    
}

if(isset($_POST['device'])){ // Modelo Device User
    
    if(isset($_POST['save'])){
        echo save_device();
    }
}

if(isset($_POST['pedido'])){ // Modelo de pedidos
    
    /*if(isset($_POST[''])){
        
    }*/
}

?>
<?php 
@header('Access-Control-Allow-Origin: *');
include('../modelo/UserModel.php'); //Modelo de usuario

if(isset($_POST['users'])){ // Modelo de usuarios
   // echo "Entró aquí";

    if(isset($_POST['login'])){ // Autenticación de usuario
      // echo "Entró aquí";
        echo login($_POST['telefono']);
    }
    
    if(isset($_POST['logout'])){
       // echo logout_user($_POST['id']);
       echo logout();
    }

    if(isset($_POST['save'])){ // Guardar usuario

        echo save($_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['tipouser']);
    }

    if(isset($_POST['update'])){

       echo  update($_POST['id'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['email'], $_POST['id_usuario'], 
       $_POST['tipouser'], $_POST['estado']);
    }

    if(isset($_POST['delete'])){
        echo elim($_POST['id'], $_POST['telefono']);
    }
    
}

?>
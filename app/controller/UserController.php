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

if(isset($_GET['users'])){ // Modelo de usuarios
    // echo "Entró aquí";
 
     if(isset($_GET['login'])){ // Autenticación de usuario
       // echo "Entró aquí";
         echo login($_GET['telefono']);
     }
     
     if(isset($_GET['logout'])){      
        echo logout();
     }
 
     if(isset($_GET['save'])){ // Guardar usuario
 
         echo save($_GET['nombre'], $_GET['apellidos'], $_GET['telefono'], $_GET['tipouser']);
     }
 
     if(isset($_GET['update'])){
 
        echo  update($_GET['id'], $_GET['nombre'], $_GET['apellidos'], $_GET['telefono'], $_GET['email'], $_GET['id_usuario'], 
        $_GET['tipouser'], $_GET['estado']);
     }
 
     if(isset($_GET['delete'])){
         echo elim($_GET['id'], $_GET['telefono']);
     }
     
 }

?>
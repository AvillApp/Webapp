<?php 
include('aplication.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//$base = "http://" . $host . $uri . "/";
$base = "http://" . $host . "/". $app. "/";

$ruta_css= $base.'app/libreria/css/';
$ruta_js = $base.'app/libreria/';
$ruta_plug = $base.'app/libreria/plug/';
$vistas = $base.'app/view/';
$modelo = $base.'app/modelo/';
// Conexión db
//$config = $base.'libreria/dependencia/Connections/conectar_bd.php';
$config = $base.'app/config.php';

// Estilos  y scripts de template (Login)
$header_login = $base.'app/template/header_login.php';
$script_login = $base.'app/template/script_login.php';
$script_portal = $base.'app/template/script_portal.php';


// Estilos  y scripts de template (Account,  y demás recursos..)
$header_account = $base.'app/template/head_css.php';
$script_account = $base.'app/template/script.php';

// Ui de template Sesión de Usuario

$header_ui = $base.'view/ui/header.php';
$menus_ui = $base.'view/ui/menus.php';
$footer_ui = $base.'view/ui/footer.php';
$images = $base.'app/libreria/image/'; // Ruta donde estarán las imagenes

?>
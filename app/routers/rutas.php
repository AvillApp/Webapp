<?php 
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$app = 'app';
//$base = "http://" . $host . $uri . "/";
$base = "http://" . $host . "/". $app. "/";

$ruta_css= $base.'libreria/css/';
$ruta_plug = $base.'libreria/plug/';
$vistas = $base.'view/';
$modelo = $base.'modelo/';
// Conexión db
//$config = $base.'libreria/dependencia/Connections/conectar_bd.php';
$config = $base.'config.php';

// Estilos  y scripts de template (Login)
$header_login = $base.'template/head_login_css.php';
$script_login = $base.'template/script_login.php';

// Estilos  y scripts de template (Account,  y demás recursos..)
$header_account = $base.'template/head_css.php';
$script_account = $base.'template/script.php';

// Ui de template Sesión de Usuario

$header_ui = $base.'view/ui/header.php';
$menus_ui = $base.'view/ui/menus.php';
$footer_ui = $base.'view/ui/footer.php';
$images = $base.'libreria/image/'; // Ruta donde estarán las imagenes

?>
<?php 
$app = 'intranet';
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocolo= 'https://';
}
else {
  $protocolo = 'http://';
}
//$protocolo = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
//$protocolo = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

//$domain = $_SERVER['HTTP_HOST'];
//$protocolo='https://';
?>
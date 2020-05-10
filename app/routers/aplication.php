<?php 
$app = 'intranet';

//$protocolo = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$protocolo = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

//$domain = $_SERVER['HTTP_HOST'];
//$protocolo='https://';
?>
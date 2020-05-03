<?php
@session_start();

function cerrar_sesion ($id){
    session_destroy($id);
}

?>
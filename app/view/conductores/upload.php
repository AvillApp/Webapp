<?php
include('../../libreria/dependencia/conexion.php');
$fecha = date('Y-mm-dd H:i:s');
?>

<?php
// A list of permitted file extensions
$allowed = array('png', 'jpeg', 'jpg');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
    $ruta=($_FILES['upl']['name']);
    
    	$nombre_extension = explode('.', $ruta);
                    		// Obtenemos la extensi贸n
                    		$extension=array_pop($nombre_extension);
                    		// Obtenemos el nombre
                    		$nombre=array_pop($nombre_extension);
    	$nombre_codificado = base64_encode($nombre." (".$fecha.")");
    	
   $nombre_real_codif = 	$nombre_codificado.".".$extension;
    	

   $directorio = '../../files/'.$nombre_codificado.".".$extension;
   // if(move_uploaded_file($_FILES['upl']['tmp_name'], $directorio))
	if(move_uploaded_file(($_FILES['upl']['tmp_name']), $directorio)){
		echo '{"status":"success"}';
		
	echo $qry = "insert into archivos (ruta, nombre, fecha_registro) values('".$nombre_real_codif."', '".$nombre."', '".$fecha."')";
				$sube=pg_query($conexion, $qry);
					if($sube){
                       echo  $_SESSION['archivo'] = $nombre_real_codif;
                        echo "1";
                    }
					
					else
					echo "2";
		
		exit;
	}
}

?>
        <?
echo '{"status":"error"}';
exit;
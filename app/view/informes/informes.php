<?php
@include('../../config.php');

$sql2 = "select pedidos.token, pedidos.vehiculo_usu, pedidos.emision, pedidos.id, pedidos.latitude, pedidos.longitude, estado.id as idestado, pedidos.fecha_update, pedidos.telealt, pedidos.id_user,
 pedidos.indicacion, pedidos.direccion, users.nombre, pedidos.fecha_registro, estado.descripcion as estado, users.telefono
 from pedidos, users, estado where estado.id=pedidos.estado and users.id=pedidos.id_user and (pedidos.estado=6 or pedidos.estado=4) order by pedidos.id desc";
$query2 = pg_query($conexion, $sql2);
$rows2 = pg_num_rows($query2);

$_SESSION['solic'] = $rows2;

?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <!--<meta http-equiv="refresh" content="80">-->

<?php


    //if($rows2){
     
  ?>
          <div class="row">

          <!-- Content Column -->
          <div class="col-lg-12 mb-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4 lg-12">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vehiculo</th>
                            <th>Desde</th>
                            <th>Destino</th>
                            <th>Indicación</th>
                            <th>Tel(Principal</th>
                            <th>Tel alternativo</th>
                            <th>Cliente</th>
                            <th>Registro</th>
                            <th>Finalización</th>
                            <th>Estado</th>
                            <th>Conductor</th>
                            <!-- <th>Rechazar</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    while($datos2=pg_fetch_assoc($query2)){

                        $q2 = "select users.nombre, users.apellidos 
                        from users, pedidos_condu
                        where users.id=pedidos_condu.id_conductor and 
                        pedidos_condu.id_pedido='".$datos2['id']."' ";
                        $r2 = pg_query($conexion, $q2);
                        $r = pg_num_rows($r2);
                            if($r){
                                $d2 = pg_fetch_assoc($r2);
                                $conductor = strtoupper($d2['nombre']." ".$d2['apellidos']);
                               
                            }                                
                            else
                                $conductor = "";
                    ?>
                        <tr>
                          <td><?php echo $i; ?> </td>
                          <td align='center'><?php echo $datos2['vehiculo_usu'] ?></td>
                          <td><?php echo $datos2['emision'] ?></td>
                          <td><?php echo $datos2['direccion'] ?></td>
                          <td><?php echo $datos2['indicacion'] ?> </td>
                          <td><?php echo $datos2['telefono'] ?></td>
                          <td><?php echo $datos2['telealt'] ?></td>
                          <td><?php echo $datos2['nombre'] ?> </td>
                          <td><?php echo $datos2['fecha_registro'] ?></td>
                          <td><?php echo $datos2['fecha_update'] ?></td>
                          <td><?php
                          if($datos2['idestado'] == 5) // En camino
                          $colore = "green";
                          else if($datos2['idestado'] == 3) // En espera
                          $colore = "red";
                          else
                          $colore = "black";
                          echo "<font color='$colore'>".$datos2['estado']."</font>"; ?> </td>                         
                          <td><?php echo $conductor; ?>
                              </td>
                          <!-- <td><button class='btn btn-primary'>Conductor</button> </td>
                          <td><button class='btn btn-danger'>Rechazar</button></td> -->
                        </tr>                        
                        <?php
                        $i++;
                      } 
                      
                      ?>
                    </tbody>
                </table>
              
            </div>

          </div>
          

   <div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id='contenido'>
       
      </div>
    </div>
  </div>

<script>
$(document).ready(function() {
    
   // $('#example').DataTable.destroy();
    $('#example').DataTable();   
   
      
  
    var btnPermiso = document.getElementById("buttonP")
    titulo = "Solicitudes",
    opciones = {
        icon: "logo.png",
        body: "Tienes nuevas solicitudes"
    };

            function mostrarNotificacion() {  
                if(Notification) {
                    if (Notification.permission == "granted") {
                      
                        var n = new Notification(titulo, opciones);
                    }

                    else if(Notification.permission == "default") {
                        alert("Primero da los permisos de notificación");
                    }

                    else {
                        alert("Bloqueaste los permisos de notificación");
                    }
                }
            };

});
</script>
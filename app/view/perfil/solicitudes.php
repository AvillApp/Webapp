<?php
@include('../../config.php');

$sql2 = "select pedidos.vehiculo_usu, pedidos.emision, pedidos.id, pedidos.latitude, pedidos.longitude, estado.id as idestado, pedidos.fecha_update, pedidos.telealt, pedidos.id_user,
 pedidos.indicacion, pedidos.direccion, users.nombre, pedidos.fecha_registro, estado.descripcion as estado, users.telefono
 from pedidos, users,estado where estado.id=pedidos.estado and users.id=pedidos.id_user and pedidos.estado!=6 order by fecha_registro";
$query2 = pg_query($conexion, $sql2);
$rows2 = pg_num_rows($query2);

?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
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
                            <th>Update</th>
                            <th>Estado</th>
                            <th>Aceptar</th>
                            <!-- <th>Conductor</th>
                            <th>Rechazar</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    while($datos2=pg_fetch_assoc($query2)){
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
                          <td><button class='btn btn-success' id='aceptar<?php echo $i ?>'>Aceptar</button> </td>
                          <!-- <td><button class='btn btn-primary'>Conductor</button> </td>
                          <td><button class='btn btn-danger'>Rechazar</button></td> -->
                        </tr>
                        <script>
                              $("#aceptar<?php echo $i ?>").click(function(){
                                 // alert("Bien<?php echo $i ?>")
                                  $("#solicitudModal").modal();
                                  $("#contenido").empty();
                                  $("#contenido").load('aceptar.php?id_pedido=<?php echo $datos2['id'] ?>');
                                  $("#contenido").show();
                              });

                              $("#conductor<?php echo $i ?>").click(function(){
                                //  alert("Bien<?php echo $i ?>")
                                  $("#solicitudModal").modal();
                                  $("#contenido").empty();
                                  $("#contenido").load('select_conductor.php');
                                  $("#contenido").show();
                              });

                              $("#rechazar<?php echo $i ?>").click(function(){
                                  //alert("Bien<?php echo $i ?>")
                                  $("#solicitudModal").modal();
                                  $("#contenido").empty();
                                  $("#contenido").load('rechazar.php');
                                  $("#contenido").show();
                              });
                            </script>
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
    $('#example').DataTable();
} );
</script>
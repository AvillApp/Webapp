<?php
@include('../../config.php');

$sql2 = "select pedidos.telealt, pedidos.id_user, pedidos.indicacion, pedidos.direccion, users.nombre, pedidos.fecha_registro
 from pedidos, users where users.id=pedidos.id_user and pedidos.estado=1 order by fecha_registro";
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
                            <th>Dirección</th>
                            <th>Indicación</th>
                            <th>Teléfono</th>
                            <th>Cliente</th>
                            <th>Fecha de registro</th>
                            <th>Estado</th>
                            <th>Aceptar</th>
                            <th>Conductor</th>
                            <th>Rechazar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    while($datos2=pg_fetch_assoc($query2)){
                    ?>
                        <tr>
                          <td><?php echo $i; ?> </td>
                          <td><?php echo $datos2['direccion'] ?></td>
                          <td><?php echo $datos2['indicacion'] ?> </td>
                          <td><?php echo $datos2['telealt'] ?></td>
                          <td><?php echo $datos2['nombre'] ?> </td>
                          <td><?php echo $datos2['fecha_registro'] ?></td>
                          <td><?php echo $datos2['nombre'] ?> </td>                         
                          <td><button class='btn btn-success' id='aceptar<?php echo $i ?>'>Aceptar</button> </td>
                          <td><button class='btn btn-primary'>Conductor</button> </td>
                          <td><button class='btn btn-danger'>Rechazar</button></td>
                        </tr>
                        <script>
                              $("#aceptar<?php echo $i ?>").click(function(){
                                  alert("Bien<?php echo $i ?>")
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
          

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
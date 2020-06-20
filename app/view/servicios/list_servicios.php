<?php
@include('../../config.php');

$sql2 = "select * from servicio ";
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
            <div class="card shadow mb-12 lg-12">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    while($datos2=pg_fetch_assoc($query2)){
                    ?>
                        <tr>
                          <td><?php echo $i; ?> </td>                         
                          <td><?php echo $datos2['nombre'] ?></td>                       
                          <td><button class='btn btn-success' id='aceptar<?php echo $i ?>'>Editar/Eliminar</button> </td>
                        </tr>
                         <script>
                              $("#aceptar<?php echo $i ?>").click(function(){
                                 // alert("Bien<?php echo $i ?>")
                                  $("#solicitudModal").modal();
                                  $("#contenido").empty();
                                  $("#contenido").load('actualizar.php?id=<?php echo $datos2['id'] ?>');
                                  $("#contenido").show();
                              });

                              // $("#conductor<?php echo $i ?>").click(function(){
                              //   //  alert("Bien<?php echo $i ?>")
                              //     $("#solicitudModal").modal();
                              //     $("#contenido").empty();
                              //     $("#contenido").load('select_conductor.php');
                              //     $("#contenido").show();
                              // });

                              // $("#rechazar<?php echo $i ?>").click(function(){
                              //     //alert("Bien<?php echo $i ?>")
                              //     $("#solicitudModal").modal();
                              //     $("#contenido").empty();
                              //     $("#contenido").load('rechazar.php');
                              //     $("#contenido").show();
                              // });
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
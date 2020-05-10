<?php
@include('../../config.php');

$sql2 = "select pedidos.telealt, pedidos.id_user, pedidos.indicacion, pedidos.direccion, users.nombre
 from pedidos, users where users.id=pedidos.id_user and pedidos.estado=1";
$query2 = pg_query($conexion, $sql2);
$rows2 = pg_num_rows($query2);

    if($rows2){
        while($datos2=pg_)
?>
<div class="row">

<!-- Content Column -->
<div class="col-lg-6 mb-4">

  <!-- Project Card Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 success bg-light">
        <!-- <h6 class="m-0 font-weight-bold text-white">Nuevo viaje</h6> -->
        <div align='center'>
            <button class='btn btn-success'>Aceptar </button>
            <button class='btn btn-primary'>Buscar conrudctor</button>
            <button class='btn btn-danger'>Rechazar</button>
        </div>
     
    </div>
    <div class='row'>
        <div class="card-body">
            <p><b>Dirección: </b><?php echo $datos2['direccion'] ?></p>
            <p><b>Indicación:</b><?php echo $datos2['indicacion'] ?> </p>
            <p><b>Teléfono:</b><?php echo $datos2['telealt'] ?> </p>
            <p><b>Nombre:</b><?php echo $datos2['nombre'] ?> </p>                    
        </div>
    </div>
    
  </div>

</div>

<div class="col-lg-6 mb-4">


  <!-- Approach -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Aplicar filtros</h6>
    </div>
    <div class="card-body">
      <p>Conductor</p>
      <select class='form-control'>
        <option></option>
      </select>
      <p><button class='btn btn-success'>Filtrar</button></p>
      <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
    </div>
  </div>

</div>
</div>
    <?php }else
    echo "No hay solicitudes del cliente";
    ?>
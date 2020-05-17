<?php 
include('../../routers/rutas.php'); // Rutas
@include('../../config.php');

// consultamos para mostrar solo los conductores disponibles
 $sql ="select * from vehiculo where id='".$_GET['id']."' ";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
 $datos = pg_fetch_assoc($query);
   

?>
<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar datos del vehículo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <?php 
         if($rows){

        ?>
           
            <hr>
            <form>

                <div class="form-group">
                    <label for="email">Nombre:</label>
                    <input type="text" class='form-control' id='nombre2' value="<?php echo $datos['nombre'] ?>"  />
                </div> 
                <div class="form-group">
                    <label for="email">Placa:</label>
                    <input type="text" class='form-control' id='placa2'  value="<?php echo $datos['placa'] ?>" />                   
                </div>  
                <div class="form-group">
                    <label for="email">Modelo:</label>
                    <input type="text" class='form-control' id='modelo2'  value="<?php echo $datos['modelo'] ?>" />                   
                </div>  
                <div class="form-group">
                    <label for="email">Marca:</label>
                    <input type="text" class='form-control' id='marca2' value="<?php echo $datos['marca'] ?>" />                   
                </div>   
                <div class="form-group">
                    <label for="email">Vigencia:</label>
                    <input type="date" class='form-control' id='vigencia2' value="<?php echo $datos['vigencia'] ?>"/>                   
                </div>               
               
            </form>

            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">CANCELAR</button>
                <a class="btn btn-success" href="javascript:;" id='confirmar'>ACTUALIZAR</a>
            </div>

            <?php 
            }else
            echo "No hay conductores disponibles";
            ?>
        
        </div>
      
</div>

<script>
$("#confirmar").click(function(){

                var nombre = $("#nombre2").val();
                var placa = $("#placa2").val();
                var modelo = $("#modelo2").val();
                var marca = $("#marca2").val();
                var vigencia = $("#vigencia2").val();
                var id="<?php echo $_GET['id'] ?>";


                var datos='vehiculo='+1+'&placa='+placa+'&modelo='+modelo+'&marca='+marca+'&vigencia='+vigencia+'&update='+1+'&nombre='+nombre+'&id='+id;

                $.ajax({

                  type: "POST",
                  data: datos,
                  dataType: "JSON",
                  url: "<?php echo $controller ?>VehiculoController.php",
                  success: function (valor){
                      if(valor.estado=='exito'){               
                          alert("Vehiculo actualizado correctamente");
                          parent.location='./';
                      }
                          
                      else
                      alert("Ocurrió un error aquí, comunícate con el administrador");
                  }
                })

    
})
 
</script>

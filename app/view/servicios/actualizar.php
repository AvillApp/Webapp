<?php 
include('../../routers/rutas.php'); // Rutas
@include('../../config.php');

// consultamos para mostrar solo los conductores disponibles
 $sql ="select * from servicio where id='".$_GET['id']."' ";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
 $datos = pg_fetch_assoc($query);
   

?>
<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar datos del servicio</h5>
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
                var id="<?php echo $_GET['id'] ?>";


                var datos='servicios='+1+'&nombre='+nombre+'&id='+id+'&update='+1;

                $.ajax({

                  type: "POST",
                  data: datos,
                  dataType: "JSON",
                  url: "<?php echo $controller ?>ServiciosController.php",
                  success: function (valor){
                      if(valor.estado=='exito'){               
                          alert("Servicio actualizado correctamente");
                          parent.location='./';
                      }
                          
                      else
                      alert("Ocurrió un error aquí, comunícate con el administrador");
                  }
                })

    
})
 
</script>

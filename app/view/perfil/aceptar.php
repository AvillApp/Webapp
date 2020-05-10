<?php 
include('../../routers/rutas.php'); // Rutas
@include('../../config.php');

// consultamos para mostrar solo los conductores disponibles
 $sql ="select id, nombre, apellidos from users where tipouser=3 and estado = 1";
 $query = pg_query($conexion, $sql);
 $rows = pg_num_rows($query);
   

?>
<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aceptar solicitud</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <?php 
         if($rows){

        ?>
            <select class='form-control' id='conductor'>
            <option value="0">SELECCIONE CONDUCTOR</option>
                 <?php while($datos=pg_fetch_assoc($query)){ ?>
                     <option value="<?= $datos['id'] ?>"><?php echo strtoupper($datos['nombre']." ".$datos['apellidos']) ?></option>
                 <?php  } ?>
            </select>
            <hr>
            <form>

                <div class="form-group">
                    <label for="email">Precio:</label>
                    <input type="number" class='form-control' id='precio' placeholder='Introduzca precio'/>
                </div> 
                <div class="form-group">
                    <label for="email">Tiempo estimado (Minutos):</label>

                    <input type="number" class='form-control' id='tiempo' placeholder='Tiempo estimado (expresar en minutos)'/>
                    <!-- <select class='form-control' id='tiempo'>
                    <option value="0">SELECCIONE TIEMPO</option>
                        <?php for($i=1;$i<=1000;$i++){ ?>
                            <option value="<?= $datos['id'] ?>"><?php echo strtoupper($datos['nombre']." ".$datos['apellidos']) ?></option>
                        <?php  } ?>
                    </select> -->
                </div>                
               
            </form>

            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">CANCELAR</button>
                <a class="btn btn-success" href="javascript:;" id='confirmar'>CONFIRMAR</a>
            </div>

            <?php 
            }else
            echo "No hay conductores disponibles";
            ?>
        
        </div>
      
</div>

<script>
$("#confirmar").click(function(){

    var conductor = $("#conductor").val();
    var precio = $("#precio").val();
    var tiempo = $("#tiempo").val();
    var id_pedido = <?php echo $_GET['id_pedido'] ?>;
    var created_by = <?php echo $_SESSION['id_user'] ?>;
    
    if(conductor!="" && precio!="" && id_pedido!=""){
        var datos='pedido=1&select_conduc=1&conductor='+conductor+'&estado='+5+'&created_by='+created_by+'&tiempo='+tiempo+'&precio='+precio+'&id='+id_pedido;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: "JSON",
                url: "<?php echo $controller ?>PedidosController.php",
                success: function (valor){
                    if(valor.estado=='exito'){               
                        alert("Conductor seleccionado y notificación enviada correctamente");
                    }
                        
                    else
                    alert("Ocurrió un error aquí, comunícate con el administrador");
                }
            })
    }else
        alert("Por favor, complete el formulario")

    
})
 
</script>

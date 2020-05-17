<?php
include('../../routers/rutas.php'); // Rutas
if(isset($_SESSION['id'])){
  
?>
<!DOCTYPE html>
<html lang="en">

<?php include($header_login) ?>
<?php include($script_portal) ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php 
          include('../ui/header.php')
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vehículos</h1>           
          </div>
          
          <!-- Content Row -->
        

    

            <!-- Earnings (Monthly) Card Example -->
           <?php include('../ui/menus.php'); ?>
         

           <div>
           <center><h1>Ingrese un nuevo vehículo</h1></center> <hr>
              <form>
                <div class="row">
               
                <div class="col">
                   <label><b>Nombre del vehículo</b></label>
                    <input type="text" class="form-control" id='nombre' placeholder="Introduzca Nombre del vehículo">
                  </div>
                  <div class="col">
                  <label><b>Placa</b></label>
                    <input type="text" class="form-control" id='placa' placeholder="Introduzca Placa">
                  </div>
                  <div class="col">
                  <label><b>Modelo<</b></label>
                    <input type="text" class="form-control" id='modelo' placeholder="Introduzca Modelo">
                  </div>
                  <div class="col">
                  <label><b>Marca</b></label>
                    <input type="text" class="form-control" id='marca' placeholder="Introduzca Marca">
                  </div>
                  <div class="col">
                    <label><b>Vigencia (Poliza)</b></label>
                    <input type="date" class="form-control" id='vigencia' placeholder="Introduzca Placa">
                  </div>  
                  <div class="col">
                   <label><b>Acción</b></label><br>
                   <input type="button" class='btn btn-primary' id='registrar' value='Registrar'>
                  </div>        
                </div>
              </form>
          </div> 
          <hr>

          <!-- Content Row -->
         <?php  include('./list_vehiculos.php') ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     <?php  include('../ui/footer.php') ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</body>

</html>
    <script>
      $(document).ready(function(){

          $("#registrar").click(function(){

                var nombre = $("#nombre").val();
                var placa = $("#placa").val();
                var modelo = $("#modelo").val();
                var marca = $("#marca").val();
                var vigencia = $("#vigencia").val();


                var datos='vehiculo='+1+'&placa='+placa+'&modelo='+modelo+'&marca='+marca+'&vigencia='+vigencia+'&save='+1+'&nombre='+nombre;

                $.ajax({

                  type: "POST",
                  data: datos,
                  dataType: "JSON",
                  url: "<?php echo $controller ?>VehiculoController.php",
                  success: function (valor){
                      if(valor.estado=='exito'){               
                          alert("Vehiculo agregado correctamente");
                          parent.location='./';
                      }
                          
                      else
                      alert("Ocurrió un error aquí, comunícate con el administrador");
                  }
                })
          });
      });
    </script>
<?php 
}else{
  ?> 
  <script>
     parent.location='<?php echo $vistas ?>login';
  </script>
  <?php
}
?>
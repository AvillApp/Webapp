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
           <center><h1>Ingrese un nuevo servicio</h1></center> <hr>
              <form>
                <div class="row">
               
                <div class="col">
                   <label><b>Nombre del servicio</b></label>
                    <input type="text" class="form-control" id='nombre' placeholder="Introduzca Nombre servicio">
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
         <?php  include('./list_servicios.php') ?>

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

                if(nombre!=""){
                    var datos='servicios='+1+'&nombre='+nombre+'&save='+1;                
                        $.ajax({

                        type: "POST",
                        data: datos,
                        dataType: "JSON",
                        url: "<?php echo $controller ?>ServiciosController.php",
                        success: function (valor){
                            if(valor.estado=='exito'){               
                                alert("Servicio agregado correctamente");
                                parent.location='./';
                            }
                                
                            else
                            alert("Ocurrió un error aquí, comunícate con el administrador");
                        }
                    })
                }else{
                    alert("Por favor introduzca el nombre del servicio");
                }
                
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
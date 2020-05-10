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
            <h1 class="h3 mb-0 text-gray-800">Solicitudes del cliente</h1>           
          </div>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-5" id='solicitudes'>
              <div class="card border-left-success  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success  text-uppercase mb-1">SOLICITUDES</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>car.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-5" id='conductores'>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">CONDUCTORES</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>user.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-4 col-md-6 mb-5" id='informes'>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">INFORMES</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>repor.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- Content Row -->
         <?php  include('../perfil/solicitudes.php') ?>

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
<?php 
}else{
  ?> 
  <script>
     parent.location='<?php echo $vistas ?>login';
  </script>
  <?php
}
?>
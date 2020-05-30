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
         

            <!-- Earnings (Monthly) Card Example -->
           <?php include('../ui/menus.php'); ?>

          <!-- Content Row -->
           <?php include('solicitudes.php'); ?>
       

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
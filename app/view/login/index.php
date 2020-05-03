<?php
include('../../routers/rutas.php'); // Rutas
?>
<!DOCTYPE html>
<html lang="en">

<?php include($header_login) ?>


<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-6  d-none d-lg-block bg-login-image">

              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Avill App</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="number" class="form-control form-control-user" id="telefono"  placeholder="Introduce número de teléfono">
                    </div>
                    <a href="#" id='ingresar' class="btn btn-success btn-user btn-block">
                      Ingresar
                    </a>   
                  </form>
                  <hr>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¿Problemas al ingresar?</h1>
                  </div>         
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include($script_login ) ?>

</body>

</html>

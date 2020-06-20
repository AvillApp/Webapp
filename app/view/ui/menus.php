<div class="row">
      
            <div class="col-xl-2 col-md-6 mb-5" id='solicitudes' style='cursor:pointer'>
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
             <div class="col-xl-2 col-md-6 mb-5" id='servicios' style='cursor:pointer'>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">SERVICIOS</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>services-512.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-2 col-md-6 mb-5" id='tipo_servicios' style='cursor:pointer'>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">TIPO DE SERVICIOS</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>tipos_services.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-5" id='vehiculos' style='cursor:pointer'>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">VEHÍCULOS</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                    </div>
                    <div class="col-auto">
                    <img src='<?php echo  $images ?>moto.png' width="60"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-5" id='conductores' style='cursor:pointer'>
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
             <div class="col-xl-2 col-md-6 mb-5" id='informes' style='cursor:pointer'>
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

            </div>

<script>

    $(document).ready(function(){

            $("#solicitudes").click(function(){

                parent.location='<?php echo $vistas ?>perfil';

            });
            $("#servicios").click(function(){
            parent.location='<?php echo $vistas ?>servicios';
            });

            $("#tipo_servicios").click(function(){
             parent.location='<?php echo $vistas ?>servicios/tipos';
            });

            $("#vehiculos").click(function(){
                parent.location='<?php echo $vistas ?>vehiculos';

            });

            $("#conductores").click(function(){


                parent.location='<?php echo $vistas ?>conductores';
            });

            $("#informes").click(function(){

                parent.location='<?php echo $vistas ?>informes';

            });
    })
</script>
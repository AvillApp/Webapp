<?php
include('config.php');
include('./routers/rutas.php');
//echo $vistas;

    if(isset($_SESSION['usuario'])){
        ?>
<script>
  parent.location = "<?php echo $vistas ?>perfil";
</script>
<?php 
    }else{
        ?>
<script>
  parent.location = "<?php echo $vistas ?>login";
</script>
<?php 
    }
?>

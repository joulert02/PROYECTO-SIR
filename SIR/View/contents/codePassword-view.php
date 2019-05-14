
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>public/css/parsley.css" rel="stylesheet" type="text/css">

<?php  
include_once "Controller/user_controller.php";
  $control = new User_Controller();
  ?>

    <section class="bienvenidos">
    <article id="particles-js" class="particulas-fondo"></article>

<section class="contenedor" id="contenedor">
<a href="index.php" class="volver"><span class="icon-arrow-left" id="atras"></span></a>
        <article style="height: 410px;" class="login">

      <form method="post" id="validate_form" class="forget-form">
        <br><br>
        <h3 class="font-green">Ingresa codigo</h3>
              <br>
              <h4>Codigo</h4>
              
              <input type="text" class="form-control" name="code" placeholder="Ingrese Codigo" required>
              

              <div class="form-group" style="display: none;">
                <?php
                $codi;
                foreach ($control->listaDatos() as $fila):
                  $codi = $fila->codigo;
                endforeach;
                ?>
              <input type="text" class="form-control"  name="coded" placeholder="Nueva contraseña" required value="<?php echo $codi; ?>">
              </div>

        <div class="col-md-8 ">
              <input type="submit" name="enviar" class="btn btn-primary" value="Guardar">
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a href="<?php echo SERVERURL?>login"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
        </div>
    </form>
</div>
</article>
</section>
<script src="public/js/particles.js"></script>
    <script src="public/js/particulas.js"></script>
    <script src="public/js/width.js"></script>
    <script src="public/iconmoon/selection.json"></script>

    <script>  
$(document).ready(function(){  
     var instance =$('#validate_form').parsley();
  });  
</script>

    <?php 
if (isset($_POST['enviar'])) {
  // $f;
  // foreach ($control->listaDatos() as $dato) {
  //   $f = $dato->codigo;
  //   }
  // echo $f;
  // if ($f == $_POST['coded']) {
  //   echo "siisisiisi";
  //   echo "siisisiisi";
  //   echo "siisisiisi";
  //   echo "siisisiisi";
  //   echo "siisisiisi";
  // }else{
  //   echo "nonono";
  // }

  if(($_POST['code']) !== ($_POST['coded'])){
  
                echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Codigo Incorrecto.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: true 
                                      }, 
                                      function(){ 
                                        ; 
                                      });  
                                </script>';

            


  }else  {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Codigo correcto.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="resetPassword"; 
                                });  
                          </script>'; 
                          }
                      
                              }
                                   
    ?>
    
 










<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>public/css/parsley.css" rel="stylesheet" type="text/css">

<!--  header  -->
<link rel="stylesheet" href="public/homepage/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/estilos.css">

<?php  
include_once "Controller/user_controller.php";
  $control = new User_Controller();
  ?>

    <section class="bienvenidos">
      <header class="encabezado navbar-fixed-top" role="banner" id="encabezado">
            <div class="container">
                  <a>
                    <img src="public/img/Rodillos GBP2.PNG " style="width: 150px; height: 70px">
                </a>

                
                <button  type="button" class="boton-menu hidden-md-up" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i></button>

                

                <nav id="menu-principal" class="collapse">
                    <ul>
                        <li><a href="<?php echo SERVERURL ?>Inicio">Inicio</a></li>
                        <li class="active"><a href="<?php echo SERVERURL ?>codePaswword">Codigo Contraseña</a></li>
                        <li><a href="<?php echo SERVERURL ?>login">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>
    <article id="particles-js" class="particulas-fondo"></article>

<section class="contenedor" id="contenedor">

        <article style="height: 410px;" class="login">

      <form method="post" id="validate_form" class="forget-form">
        
        <h3 >Ingrese codigo</h3>
              
              <h5 style="margin-top: 20%">Codigo</h5>
              
              <input style="margin-top: 5%" type="text" class="form-control" name="code" placeholder="Ingrese Codigo" required>
              

              <div class="form-group" style="display: none;">
                <?php
                $codi;
                foreach ($control->listaDatos() as $fila):
                  $codi = $fila->codigo;
                endforeach;
                ?>
              <input type="text" class="form-control"  name="coded" placeholder="Nueva contraseña" required value="<?php echo $codi; ?>">
              </div>

        <div class="form-actions" style="margin-top: 20%">
              <input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a href="<?php echo SERVERURL?>login"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
        </div>
    </form>
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
    
 









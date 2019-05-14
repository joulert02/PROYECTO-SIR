
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
 require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
$usuario = new Usuario();
$control = new User_Controller();
$resultado=$control->buscar('id_usuario');

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
                        <li class="active"><a href="<?php echo SERVERURL ?>codePaswword">Restablecer Contraseña</a></li>
                        <li><a href="<?php echo SERVERURL ?>login">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>
    <article id="particles-js" class="particulas-fondo"></article>

<section class="contenedor" id="contenedor">
        <article style="height: 410px;" class="login">
      <form method="post" id="validate_form" class="forget-form">
        <br><br>
        <h3 class="font-green">Nueva Contraseña</h3>
              <br>
              <h4>Nueva Contraseña</h4>
              <input type="password" class="form-control" ID="pass2" name="password" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" placeholder="Nueva contraseña"><button style="height: 35px;"  id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword()"><li style="color:black;" class="fa fa-eye-slash icon"></li></button>

              <h4>Confirme Contraseña</h4>
    
              <input type="password" class="form-control" name="confirm" ID="txtPassword2" required data-parsley-equalto="#pass2" data-parsley-trigger="keyup" placeholder="Confirme Contraseña contraseña"><button style="height: 35px;"  id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword2()"><li style="color:black;" class="fa fa-eye-slash iconn"></li></button>
        <br>
        <div class="row">
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
  $usuario->__SET('password',MD5($_POST['password']));
  if(($_POST["password"])!==($_POST["confirm"])){
  
                echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Las contraseñas no coinciden.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="resetPassword"; 
                                      });  
                                </script>';

           if (($_POST["password"] =="")&&($_POST["confirm"] == "")){
              echo "<script>swal('Error al cambiar la contraseña','Campos Requeridos','error')</script>";
          }

            
             else if (($_POST["password"] =="")){
                echo "<script>swal('Error al cambiar contraseña','Campo Nueva Contraseña Requerido','error')</script>";
            }
            else if (($_POST["confirm"] =="")){
                echo "<script>swal('Error al cambiar contraseña','Campo Confirme Contraseña Requerido','error')</script>";
            }           


  }else if ($control->actualizar1($usuario)) {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Contraseña Cambiada Correctamente,Inicia sesion con tu nueva contraseña.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="'.SERVERURL.'login"; 
                                });  
                          </script>'; 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="resetPassword"; 
                                      });  
                                </script>';    
    ?>
    <meta http-equiv="refresh" content="0; url=changePassword-view.php">
<?php 
  }
}else{

} ?>


<script>
    function mostrarPassword(){
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    } 

    function mostrarPassword2(){
        var cambios = document.getElementById("txtPassword2");
        if(cambios.type == "password"){
            cambios.type = "text";
            $('.iconn').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambios.type = "password";
            $('.iconn').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    } 
    
</script>






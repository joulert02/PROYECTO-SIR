 <?php
  require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
  $usuario = new Usuario();
  $control = new User_Controller();
  $resultado = $control->buscar('id_usuario');
  ?>
 <br><br>
 <style type="text/css">
   .container {
     width: 1370px;
     height: 350px;
     display: flex;
     flex-direction: column;
     align-items: center;
     justify-content: center;
   }
 </style>
 <div class="container-fluid">
   <div class="col-md-8 col-xs-12 col-md-offset-2 mt-1">
     <div class="panel panel-default">
       <div class="panel-heading clearfix">
         <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
         <label>
           <h4><b>Cambiar Contraseña</b></h4>
         </label>
       </div>
       <div class="panel-body">
         <form method="post" action="#" id="validate_form">
           <div class="form-row">
             <div class="col-md-6 mb-3" style="display: flex;">
               <label for="oldPassword" class="control-label">Antigua contraseña</label>&nbsp
               <input style="border-right:0;" type="password" ID="txtPassword" class="form-control" name="old-password" required data-parsley-length="[6, 15]" placeholder="Antigua contraseña"><button style="height: 35px; border-left:0;" id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword()">
                 <li style="color:black;" class="fa fa-eye-slash icon"></li>
               </button>
             </div>

             <div class="col-md-6 mb-3" style="display: flex;">
               <label for="newPassword" class="control-label">Nueva contraseña</label>&nbsp
               <input style="border-right:0;" type="password" class="form-control" name="password" ID="txtPassword2" required data-parsley-length="[6, 15]" placeholder="Nueva Contraseña"><button style="height: 35px;" id="show_password" class="btn btn-light" type="button" onclick="mostrarPassword2()">
                 <li style="color:black;" class="fa fa-eye-slash iconn"></li>
               </button>
             </div>
             <br>
             <br>
             <br>
             <br>
             <div class="col-md-12 mb-3">
               <input type="submit" name="enviar" class="btn btn-primary" value="Actualizar">
               <input type="reset" value="Limpiar" class="btn btn-secondary">
               <a href="<?php echo SERVERURL ?>editAccount"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
             </div>
           </div>
       </div>
       <br>
       </form>
     </div>
   </div>
 </div>
 </div>
 </div>

 <script>
   $(document).ready(function() {
     var instance = $('#validate_form').parsley();
   });
 </script>


 <?php

  if (isset($_POST['enviar'])) {
    if ( mainModel::encryption($_POST['old-password']) !== ($_SESSION['password_sir'])) {
      echo '<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Tu contraseña antiagua no es correcta.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="changePassword"; 
                                      });  
                                </script>';

      if (($_POST["password"] == "") && ($_POST["old-password"] == "")) {
        echo "<script>swal('Error al cambiar la contraseña','Campos Requeridos','error')</script>";
      } else if (($_POST["password"] == "")) {
        echo "<script>swal('Error al cambiar la contraseña','Campo Nueva Contraseña Requerido','error')</script>";
      } else if (($_POST["old-password"] == "")) {
        echo "<script>swal('Error al iniciar sesión','Campo Antigua Contraseña Requerido','error')</script>";
      }
    } else {
      require_once "./Controller/loginController.php";
      $lc = new loginController();
      echo $lc->cambiar_clave_controlador("editAccount/");
    }
  } ?>


 <script>
   function mostrarPassword() {
     var cambio = document.getElementById("txtPassword");
     if (cambio.type == "password") {
       cambio.type = "text";
       $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
     } else {
       cambio.type = "password";
       $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
     }
   }

   function mostrarPassword2() {
     var cambios = document.getElementById("txtPassword2");
     if (cambios.type == "password") {
       cambios.type = "text";
       $('.iconn').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
     } else {
       cambios.type = "password";
       $('.iconn').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
     }
   }
 </script>
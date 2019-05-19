 <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
 <?php
    // require_once 'core/configAPP.php';
    // $output=FALSE;
    // $key=hash('sha256', SECRET_KEY);
    // $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    // $output=openssl_encrypt("admin1234", METHOD, $key, 0, $iv);
    // $output=base64_encode($output);
    // echo $output;

    ?>
 <section class="bienvenidos">
     <article id="particles-js" class="particulas-fondo"></article>
     <section class="contenedor" id="contenedor">
         <a href="<?php echo SERVERURL ?>Inicio" class="volver"><span class="icon-arrow-left" id="atras"></span></a>
         <article class="login">
             <img class="img1" src="<?php echo SERVERURL ?>public/img/user-img.1.jpg" alt="">
             <h3>Iniciar sesión</h3><br>

             <form id="validate_form" data-form="save" action="" method="POST" class="clearfix FormularioAjax" id="validate_form">
                 <label>Ingrese Correo</label>
                 <input class="inp" type="email" name="usuario" title="Ingrese su correo" required data-parsley-type="email" data-parsley-trigger="keyup"><br>
                 <label>Ingrese Contraseña</label>
                 <input ID="txtPassword" class="inp" type="password" name="clave" title="Ingrese su contraseña" required data-parsley-trigger="keyup" autocomplete="off">
                 <li class="fa fa-eye-slash icon " id="show_password" onclick="mostrarPassword()"></li>
                 <input class="boton" type="submit" name="enviar" value="Iniciar Sesión">
             </form>

             <a href="<?php echo SERVERURL ?>recoverPassword" id="forget-password" class="forget-password">¿Olvido su Contraseña?</a>
             <br>
         </article>
     </section>
 </section>

 <?php
    if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        require_once './Controller/loginController.php';
        $login = new loginController();

        echo $login->iniciar_sesion_controlador();
    }
    ?>

 <script>
     $(document).ready(function() {
         var instance = $('#validate_form').parsley();
     });

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
 </script>
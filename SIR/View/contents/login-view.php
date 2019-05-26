  

<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/estilos.css">
 <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<!--  header  -->
<link rel="stylesheet" href="<?php echo SERVERURL ?>public/homepage/css/bootstrap.css">
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
    <header class="encabezado navbar-fixed-top" role="banner" id="encabezado">
            <div class="container">
                  <a>
                    <img src="<?php echo SERVERURL ?>public/img/Rodillos GBP2.PNG " style="width: 150px; height: 70px">
                </a>

                
                <button  type="button" class="boton-menu hidden-md-up" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i></button>

                

                <nav id="menu-principal" class="collapse">
                    <ul>
                        <li><a href="<?php echo SERVERURL ?>Inicio">Inicio</a></li>
                        <li class="active"><a href="<?php echo SERVERURL ?>login">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>

    <article id="particles-js" class="particulas-fondo"></article>
    <section class="contenedor" id="contenedor">
        <article class="login" style="margin-top: 70px;">
            <img class="imagen" src="<?php echo SERVERURL ?>public/img/Rodillos GBP.png" alt="">
            <h3>Iniciar sesión</h3><br>

            <form id="validate_form"  data-form="save" action="" method="POST" class="clearfix FormularioAjax" id="validate_form">
                <label>Ingrese Correo</label>
                <input class="inp" type="email" name="usuario" title="Ingrese su correo" required data-parsley-type="email" data-parsley-trigger="keyup">
                <label style="margin-top: 3%">Ingrese Contraseña</label>
                <input ID="txtPassword" class="inp" type="password" name="clave" title="Ingrese su contraseña" required data-parsley-trigger="keyup" autocomplete="off"><li class="fa fa-eye-slash icon " id="show_password" onclick="mostrarPassword()"></li>
                <input class="boton" type="submit" name="enviar" value="Iniciar Sesión">
            </form>
            
            <a href="<?php echo SERVERURL?>recoverPassword" id="forget-password" class="forget-password" style="margin-top: 3%">¿Olvido su Contraseña?</a>
            <br>
        </article>
    </section>
</section> </section>

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
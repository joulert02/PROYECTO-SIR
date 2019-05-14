 
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/estilos.css">
 <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<!--  header  -->
<link rel="stylesheet" href="public/homepage/css/bootstrap.css">
    




<?php 
require_once 'Controller/controller_login.php';
$control= new IniciarSesion();

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
                        <li class="active"><a href="View/contents/parsey.php">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>

    <article id="particles-js" class="particulas-fondo"></article>
    <section class="contenedor" id="contenedor">
        <article class="login" style="margin-top: 70px;">
          <img class="imagen" src="<?php echo SERVERURL ?>public/img/user-img.1.jpg" alt="">
          <h3>Iniciar sesión</h3><br>
           <form method="post" class="clearfix" id="validate_form">
            <label>Ingrese Correo</label>
            <input class="inp" type="email" name="user" title="Ingrese su correo" required data-parsley-length="[3,25]" data-parsley-type="email"  data-parsley-trigger="keyup" ><br>
            <label>Ingrese Contraseña</label>
            <input ID="txtPassword" class="inp" type="password" name="pass" title="Ingrese su contraseña" required data-parsley-trigger="keyup"><li class="fa fa-eye-slash icon " id="show_password" onclick="mostrarPassword()"></li>

<style>            
form button{
    margin-right: 0px;
    background-color: rgba(255,255,255,.6);
    color: #000;
    height: 25px;
    width: 10%;
    border: solid 2px rgba(255,255,255,.01);
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
           
            <input class="boton" type="submit" name="enviar" value="Iniciar Sesión">
          </form>
          <br>
          <a href="<?php echo SERVERURL?>recoverPassword" id="forget-password" class="forget-password">¿Olvido su Contraseña?</a>
          <br>
        </article>
    </section>
</section>

  <script>  
$(document).ready(function(){  
     var instance =$('#validate_form').parsley();
  });  
</script>

<?php 
if (isset($_POST['enviar'])) {
    $usu=$_POST['user'];
$pass=$_POST['pass'];
if (($usu == "")&&($pass == "")){
    echo "<script>swal('Error al iniciar sesión','Campos Requeridos','error')</script>";
}
if (($usu == "")){
    echo "<script>swal('Error al iniciar sesión','Campo Correo Requerido','error')</script>";
}
else if (($pass == "")){
    echo "<script>swal('Error al iniciar sesión','Campo Contraseña Requerido','error')</script>";
}
else if ($control->iniciar($usu,$pass)) {
    echo'<script type="text/javascript"> 
                            swal({title: "Sesión Iniciada Con Exito",       
                                  text: "Bienvenido Administrador ", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="'.SERVERURL.'homeAdmin"; 
                                });  
                          </script>'; 
}else{

echo "<script>swal('Error al iniciar sesión','contraseña y/o correo no coinciden, intente de nuevo','error')</script>";

 }

}

 ?>
<script src="<?php echo SERVERURL; ?>public/js/particulas.js"></script> 

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
    
</script>
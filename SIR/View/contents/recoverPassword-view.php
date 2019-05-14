
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/iconmoon/style.css">
<link href="<?php echo SERVERURL; ?>public/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>public/css/parsley.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--  header  -->
<link rel="stylesheet" href="public/homepage/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/estilos.css">

<?php 
    include 'View/contents/includes/config1.php';
    include 'View/contents/includes/functionBD.php';
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
                        <li class="active"><a href="<?php echo SERVERURL ?>recoverPassword">Recuperar Contraseña</a></li>
                        <li><a href="<?php echo SERVERURL ?>login">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>
    <article id="particles-js" class="particulas-fondo"></article>
    <section class="contenedor" id="contenedor">
        <article class="login">


    <form class="forget-form" id="validate_form" method="post">
                <h3 class="font-green">¿Olvido Su Contraseña?</h3>
                <br>
                <h4>Ingrese su correo</h4>
                
                    <input class="form-control" type="email" placeholder="Ingrese su correo" name="email" required data-parsley-type="email" data-parsley-trigger="keyup"><br>


                <div class="form-group" style="display: none;">
                    <h4>Codigo</h4>
          <input type="text" name="codigo" class="form-control" required="" value="<?php $key = '';
                                             $longitud = 10;
                                              $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                                              $max = strlen($pattern)-1;
                        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 
                       echo $key; ?>">
                       <br>
                       
                </div>

                
                <div class="row">
                    <input type="submit"  name="correo" class="btn btn-primary" value="Aceptar">
                     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="<?php echo SERVERURL; ?>login"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
                
                </div>
                </form>
            </article>
        </section>

<script>  
$(document).ready(function(){  
     var instance =$('#validate_form').parsley();
  });  
</script>

<?php
    $bd = new GestarBD;
 
if(isset($_POST["correo"])){

  $codigo = $_POST['codigo'];
 $conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
 $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Consulta = $conec->prepare("UPDATE tbl_usuario SET codigo='$codigo' WHERE id_usuario=1");
$Consulta ->  execute();
 

 if (($_POST["correo"] ==""))  
        {
             echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Campo Requerido.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="recoverPassword"; 
                                      });  
                                </script>';                   
        }
            
                    $destino = $_POST['email'];
                //$cs=mysqli_query($sql,$conexion);
               
                $usuario = $bd->SelectText('*', 'tbl_usuario', "correo='$destino'",false,null,null);
                $bd->consulta($usuario);
                if ($mostrar = $bd->mostrar_registros()) {
                    $nombre= $mostrar->nombre;
                    $mail= $mostrar->correo;
                    $clave= $mostrar->password;
                    $codigo= $mostrar->codigo;
                    $correozippy="jhoanhenao820@gmail.com";
            
                    $casilla = 'jhoanhenao820@gmail.com';
                    $asunto = '';
                    $cabeceras = "From: "  .$correozippy.  "\r\n";
                    $cabeceras .= "Reply-To: ".$correozippy. "\r\n";
                    $cabeceras .= "MIME-Version: 1.0\r\n";
                    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $mensaje = '<html><body>';
                    $mensaje .= '<p>Hola '. $nombre .' Con el siguiente codigo puedes recuperar tu contraseña  </p>';
                    $mensaje .= '<p>Codigo: ' .$codigo. '</p>';
                    $mensaje .= "</body></html>";
                    $para = "$mail";
                    $asunto = 'Recupera tu contraseña';
                    
                    
                  $correo = mail($para, $asunto, $mensaje, $cabeceras);

                
                  
                    if($correo){
                        echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Se ha enviado al correo la recuperación de la contraseña.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="codePassword"; 
                                });  
                          </script>'; 
                    }
                    else{
                   echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se pudo obtener los datos del correo '.$destino.'.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="recoverPassword"; 
                                      });  
                                </script>';
                }
                }
            
        }

        ?>




    <script src="public/js/particles.js"></script>
    <script src="public/js/particulas.js"></script>
    <script src="public/js/width.js"></script>
    <script src="public/iconmoon/selection.json"></script>


   
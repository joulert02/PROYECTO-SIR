<style type="text/css">
    
input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
 
 
 
</style>

   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


<script src="../../public/js/parsley.js"></script> 

<link rel="stylesheet" href="../../public/iconmoon/style.css">
<link href="../../public/css/sweetalert.css" rel="stylesheet" type="text/css">

<script src="../../public/js/sweetalert.min.js"></script>                
  <script src="../../public/js/sweetalert-dev.js"></script>   

<script src="../../public/js/bootstrap.min.js"></script>  

<?php
  require_once "../../Controller/sugerenciaController.php";
  require_once '../../Model/sugerenciaModel.php';
  $control = new comentarioController();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rodillos Mastder | Inicio</title>
    <link rel="stylesheet" href="../../public/homepage/iconmoon/style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Montez" rel="stylesheet">

    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="../../public/homepage/images/cooker_1_.ico">

    <!-- Cargando fuentes -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Cargando iconos -->
    <link href='../../public/homepage/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- Carga de Galeria de imágenes -->
    <link rel="stylesheet" href="../../public/homepage/css/owl.carousel.min.css">

    <!-- Carga de archivos css -->
    <link rel="stylesheet" href="../../public/homepage/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/homepage/css/animate.min.css">
    <link rel="stylesheet" href="../../public/homepage/css/estilos.css">


</head>

<body>
    <section class="bienvenidos">

          <header class="encabezado navbar-fixed-top" role="banner" id="encabezado">
            <div class="container">
                 <a>
                    <i aria-hidden="true"></i> <h3>Rodillos Mastder</h3>
                </a>

                
                <button  type="button" class="boton-menu hidden-md-up" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i></button>

                

                <nav id="menu-principal" class="collapse">
                    <ul>
                        <li class="active"><a href="inicio.php">Inicio</a></li>
                        <li><a href="login.php">Inicio de Sesión</a></li>

                    </ul>
                </nav>

            </div>
        </header>

        <div class="texto-encabezado text-xs-center">

            <div class="container">
                <h1 class="display-4 wow bounceIn">Bienvenidos a rodillos GBP</h1>
                <p class="wow bounceIn" data-wow-delay=".3s">"Lo Mejor en rodillos"</p>
                <a href="<?php echo SERVERURL?>login" class="btn btn-primary btn-lg">Inicia Sesión!</a>

</div>
            </div>

        </div>
        <div class="flecha-bajar text-xs-center">
            <a data-scroll href="#agencia"> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
        </div>

    </section>








<div class="paginas-internas">

  <section class="ruta py-1">
        <div class="container"> 
            <center>
                 <h2 class="wow bounceIn" data-wow-delay=".3s">¿Quiénes somos? y ¿Qué hacemos?.</h2>
            </center>
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="index_restaurante.php">Inicio</a> » Nosotros

                </div>
            </div>
        </div>
    </section>
    <main class="py-1">
        <div class="container">
            <div class="row">
                <article class="col-md-8">
                    <h2>¡Conocenos!</h2>
                    <p>
                        Rodillos Mastder es una ferreteria que ofrece una completa gama de productos de alta calidad a un precio justo.
                    </p>



                    <div id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">

                            <h4 class="panel-heading">
 <a data-toggle="collapse" data-parent="#accordion" href="#tab-mision"> MISIÓN </a>

                            </h4>
                            <div id="tab-mision" class="panel-collapse collapse in">
                        
<p>Satisfacer las necesidades del pintor profesional y del hogar, proporcionandole rodillos y accesorios para pintar de la mas alta calidad. </p>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <h4 class="panel-heading">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#tab-vision" >VISIÓN</a>

                            </h4>
                            <div id="tab-vision" class="panel-collapse collapse">
                                
<p>Industria Mastder sera reconocida como la organizacion lider en el mercado nacional e internacional por: Ofrecer una completa gama de productos para atender todas las necesidades del pintor. Proporcionar productos de alta calidad y durabilidad a un precio justo. Contar con una amplia red de distribucion gracias a excelentes relaciones comerciales con almacenes de pinturas, ferreterias, almacenes de cadena y grandes distribuidores nacionales e internacionales. La calidad en nuestros productos y en la atencion de los clientes, apoyada por un grupo humano que trabaja para satisfacer sus necesidades.
</p>

                            </div>
                        </div>


                        <div class="panel panel-default">
                            <h4 class="panel-heading">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#tab-objetivos" >
        OBJETIVOS
        </a>

                            </h4>
                            <div id="tab-objetivos" class="panel-collapse collapse">
                                
                                    <p>Generales:</p> 
<p>El objetivo central de nuestro proyecto es que nuestro aplicativo facilite los procesos de rodillos mastder de una manera correcta y rápida.

</p>
                                    <p>Específicos:</p> 
-Que nuestro aplcativo cumpla con sus funcones
</p>

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <h4 class="panel-heading">

        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#tab-quienessomos" > QUIENES SOMOS
        </a>

                            </h4>
                            <div id="tab-quienessomos" class="panel-collapse collapse">
                                 
                                    <p>Rodillos Mastder fue la primera empresa en elaborar y distribuir rodillos para pintar en Colombia y a su vez, fue pionera en la enseñanza
                                     sobre la utilizacion y ventajas de esta herramienta en nuestro pais La experiencia del fundador de Rodillos Mastder Ltda, en el ramo de la 
                                     pintura, adquirida durante su trabajo en una multinacional en la decada de los 60 le permitio posicionarse como unico productor Colombiano
                                      en el mercado de los accesorios para pintar a niivel nacional. Actualmente Rodillos Mastder Ltda, ostenta su liderazgo en el mercado 
                                      Colombiano, gracias al compromiso de sus funcionarios, al servicio al cliente y a la calidad de sus productores, lo que le ha permitido
                                       incursionar en otros paises latinoamericanos con el mismo exito.

</p>

                            </div>
                        </div>
                    </div>




                </article>
                <aside class="col-md-4">
                    <center>
                    <img style="height: 55%;" src="../../public/img/rodillo.jpg" alt="Nosotros">
                    </center>

                </aside>


            </div>
        </div>
    </main>
  </div>








<div class="paginas-internas">

  <section class="ruta py-1">
        <div class="container"> 
            <center>
                 <h2 class="wow bounceIn" data-wow-delay=".3s">Aqui nos puedes contactar.</h2>
            </center>
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="index_restaurante.php">Inicio</a> » Nosotros

                </div>
            </div>
        </div>
    </section>

<main class="py-1">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <h2 class="m-b-2">Contáctenos</h2>

                    <center>

                    Rodillos Mastder Ltda.
Carrera 108 No. 19-62</br>
Telefonos: 267 6353 - 4153290</br>
e-mail: informacion@industriasmastder.com</br>
www.industriasmastder.com</br>
Medellin - Colomcia - Sur America</br>
</center>



              <h3 class="m-b-2">Enviar Opinión</h2>

<!-- formulario registro -->


                    <form method="post" id="validate_form">

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label">Nombres</label>

                            <div class="col-md-8">
                                <input class="form-control" type="text"  name="nombre" placeholder="Ingrese su nombre " data-toggle="tooltip" data-placement="top" title="Ingrese su nombre " required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label">Correo Electronico</label>

                            <div class="col-md-8">
                                <input class="form-control" type="email"  name="correo" required placeholder="Ingrese Correo Electronico" data-toggle="tooltip" data-placement="top" title="Ingrese  Correo Electronico" required="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label">Teléfono</label>

                            <div class="col-md-8">
                                <input class="form-control" type="number"  name="telefono" placeholder="Ingrese su teléfono" data-toggle="tooltip" data-placement="top" title="Ingrese su teléfono" required="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label">Comentario</label>

                            <div class="col-md-8">
                                <textarea class="form-control" type="text"  name="comentario" placeholder="Ingrese descripción" data-toggle="tooltip" data-placement="top" title="Ingrese descripción" required=""></textarea>
                            </div>
                        </div>

                        
                            <label style="display:none"  class="col-md-4 col-form-label">Fecha</label>
                                <input style="display:none" class="form-control" type="datetime"  name="fecha" placeholder="Ingrese descripción" data-toggle="tooltip" data-placement="top" title="Ingrese descripción" required="" value="<?php echo date("Y-m-d H.i.s");?>">
                           

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <input type="submit" class="btn btn-primary" name="registrar" value="Enviar"/>
                                <button type="reset" class="btn btn-secondary">Limpiar</button>
                            </div>
                        </div>
                    </form>
  
   <script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>

        <?php 
if (isset($_POST['registrar'])) {
  $categoria = new comentarioModel();

    $categoria->__SET('nombre',$_POST['nombre']);
  $categoria->__SET('correo',$_POST['correo']);
  $categoria->__SET('telefono',$_POST['telefono']);
  $categoria->__SET('comentario',$_POST['comentario']);
  $categoria->__SET('fecha',$_POST['fecha']);

    if (($categoria->nombre == ""))  
        {
             echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'Inicio"; 
                                      });  
                                </script>';
                                return false;    
        }
    else if ($control->insertar($categoria)) {

                 echo "<script> 
    swal('Bien Hecho','Comentario Exitoso', 'success')</script>";
                          }else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar la categoria.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'Inicio"; 
                                      });  
                                </script>';    
        ?>
        
<?php 
    }
} ?>

 <h3 class="m-b-2">Ubicación</h2>
                    <br>
                    <center>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4699761353195!2d-75.58346158535396!3d6.201562595510554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13
        .1!3m3!1m2!1s0x8e46827be1e85e35%3A0x8fd423ce9b14c888!2sCl.+6+Sur%2C+Medell%C3%ADn%2C+Antioquia!5e0!3m2!1ses-419!2sco!4v1536629734446" width="350" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
        </center>

       
                   <!-- Content -->
<div id = "content_area">
  
</div>

</div>
<aside class="col-md-4">
                    <h3>Aqui nos puedes contactar</h3>
                    <p> Aqui esta toda nuestra informacion para contactarnos contigo puedes llamar o enviar una opinion,pregunta e.t.c </p>
                    <img style="height: 65%;" src="../../public/img/nosotros.svg" alt="Nosotros">
                </aside>
</div>
</div>
</main>


  </div>



















   


  

 <section class="ultimos-proyectos py-1">
  <section class="agencia py-1" id="agencia">
        <div class="container">
            <center>
            <h2 class="wow bounceIn" data-wow-delay=".3s">Galeria de imagenes.</h2>
        </center>
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="inicio.php">Inicio</a> » Contactenos

                </div>
            </div>
        </div>
      </section>
   






        <div class="container">
            

            <div class="owl-carousel">
                <a>
                    <h4>Marcas</h4>
                    <img src="../../public/homepage/images/marcas.png" alt="App Lima Travels">
                </a>

                <a >
                    <h4>Colaboradores</h4>
                    <img src="../../public/homepage/images/colaboracion.jpg" alt="Apps Uber">
                </a>

                <a >
                    <h4>Rodillo</h4>
                    <img src="../../public/homepage/images/rodillo.jpg" alt="App Pizza Perú">
                </a>


                <a>
                    <h4>Rodillos</h4>
                    <img src="../../public/homepage/images/5.jpg" alt="App Clima Perú">
                </a>
                <a>
                    <h4>Rodillos</h4>
                    <img src="../../public/homepage/images/5.jpg" alt="App Clima Perú">
                </a>

              <!--  <a>
                    <h4>Rodillos Y Brochas</h4>
                    <img src="../../public/homepage/brochas.jpg" alt="">
                </a>-->

            </div>
        </div>
    </section>

    <footer class="piedepagina py-1" role="contentinfo">
        <div class="container">
            <p>2019 Rodillos GBP</p>
            <ul class="redes-sociales">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"> </i>  </a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i> </a></li>
            </ul>

        </div>

    </footer>

    <a data-scroll class="ir-arriba" href="#encabezado"><i class="fa  fa-arrow-circle-up" aria-hidden="true"> </i> </a>

    <!-- Carga de archivos  JS -->

    <script src="../../public/homepage/js/jquery.min.js"></script>
    <script src="../../public/homepage/js/bootstrap.min.js"></script>
    <script src="../../public/homepage/js/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            autoWidth: false,
            navText: ['<i class="fa fa-arrow-circle-left" title="Anterior"></i>', '<i class="fa  fa-arrow-circle-right" title="Siguiente"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2,
                    margin: 20
                },
                800: {
                    items: 3,
                    margin: 20
                },
                1000: {
                    items: 4,
                    margin: 20
                }
            }
        })

    </script>
    <script src="../../public/homepage/js/wow.min.js"></script>
    <script src="../../public/homepage/js/smooth-scroll.min.js"></script>
    <script src="../../public/homepage/js/sitio.js"></script>


</body>

</html>

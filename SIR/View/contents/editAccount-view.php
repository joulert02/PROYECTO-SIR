<?php
  require_once 'Controller/user_controller.php';
  require_once 'Model/user_model.php';
$usuario = new Usuario();
$control = new User_Controller();
$resultado=$control->buscar('id_usuario');
?>
<br>
<div class="container-fluid">
  <div class="col-md-8 col-xs-12 col-md-offset-2 mt-1">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Cuenta</b></h4></label>
          </div>
        <div class="panel-body">
          <div class="form-row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="<?php echo $_SESSION['url_sir']; ?>" alt="">
            </div>
            <div class="col-md-8">
              <h5><label class="control-label">Seleccione una imagen</label></h5>
              <form class="form" id="validate_form"  method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="img" class="btn btn-default btn-file" required />
              </div>
              <div class="form-group">
                <input type="submit" name="cambiar" class="btn btn-primary" value="Cambiar">
              </div>
             </form>
            
             </div>
          

             <form method="post" action="#" id="validate_form2" class="clearfix">
              <div class="form-row">
            <div class="col-md-6 mb-3">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="name" class="form-control" name="nombre" required value="<?php echo $_SESSION['usuario_sir']; ?>">  <br>
            </div>
            <div class="col-md-6 mb-3">
                  <label for="username" class="control-label">Correo</label>
                  <input type="email" class="form-control" name="correo" required data-parsley-type="email" value="<?php echo $_SESSION['correo_sir']; ?>">  <br>
            </div>
            <div class="col-md-12 mb-3">
                    <a href="<?php echo SERVERURL ?>changePassword" title="change password" class="btn btn-danger pull-right">Cambiar contraseña</a>
                    <input type="submit" name="enviar" class="btn btn-primary" value="Actualizar">
            </div>
          </div>
        </form>
            </div>
          </div>
        </div>
  </div>
  </div>
</div>

<script>  
$(document).ready(function(){  
     var instance =$('#validate_form').parsley();
  });  
$(document).ready(function(){  
     var instance =$('#validate_form2').parsley();
  });  
</script>

<?php 
if (isset($_POST['cambiar'])) {
$conexionbd = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$nombrefoto = $_FILES['img']['name'];
$rutaaguardar = $_FILES['img']['tmp_name'];
$destinourl = "public/img/".$nombrefoto;
copy($rutaaguardar,$destinourl);

$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE tbl_usuario set imagen='$nombrefoto', url='$destinourl' WHERE id_usuario=1";
$conexionbd->exec($sql);
$_SESSION['url_sir']=$destinourl;
echo'<script type="text/javascript"> 
swal({title: "LISTO",    
      text: "Imagen actualizada correctamente!.", 
      type:"success", 
      confirmButtonText: "OK", 
      closeOnConfirm: false 
    }, 
    function(){ 
      window.location.href="'.SERVERURL.'editAccount"; 
    });  
</script>'; 

} 
?>


  <?php 
if (isset($_POST['enviar'])) {
  $usuario->__SET('nombre',$_POST['nombre']);
  $usuario->__SET('correo',$_POST['correo']);

   if (($_POST["nombre"] =="")&&($_POST["correo"] == "")){
                echo "<script>swal('Error al editar cuenta','Campos Requeridos','error')</script>";
            }
            else if (($_POST["nombre"] =="")){
                echo "<script>swal('Error al editar cuenta','Campo Nombre Requerido','error')</script>";
            }
            else if (($_POST["correo"] =="")){
                echo "<script>swal('Error al editar cuenta','Campo Correo Requerido','error')</script>";
            }

  else if ($control->actualizar($usuario)) {
    echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "Cuenta Actualizada Correctamente.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="editAccount"; 
                                });  
                          </script>'; 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la cuenta.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="editAccount"; 
                                      });  
                                </script>';    
    ?>
    <meta http-equiv="refresh" content="0; url=editAccount">
<?php 
  }
}else{

} ?>


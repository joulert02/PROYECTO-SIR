<?php 
require_once '../../../Controller/Order Controller/pedido_controller.php';
require_once '../../../Model/Order Model/Pedido_model.php';
$pedido = new Pedido();
$control = new Pedido_Controller();
require "global.php";
require "menu.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="widht=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<title>Pedidos</title>

  <link rel="stylesheet" href="../../../Assets/form_bootstrap/css/bootstrap.min.css">
  <script src="../../../Assets/parsley/js/parsley.js"></script>
  <link rel="stylesheet" href="../../../Assets/parsley/css/parsley.css"">

</head>
<body>

  <style type="text/css">
    .container{  
     width:900px;
     height: 415px;
   }
</style>

<br>        
<div class="container card card-body mb-5 mt-5">

    <h1><i class="fa fa-cart-plus fa-x3"> Registrar Pedido</i></h1>
    <form action="#" id="validate_form" method="post" class="ml-2">

      <br>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label>Id Persona*</label><br>
          <input type="number" name="Persona_id_persona" class="form-control" placeholder="Ingrese Id Persona" required =""><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Vendedor*</label><br>
          <input type="text" name="vendedor" class="form-control" placeholder="Ingrese Vendedor"  required ="" ><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Fecha Pedido*</label><br>
          <input type="date" name="fecha_pedido" class="form-control" placeholder="Ingrese Fecha Pedido"  required="" ><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Fecha Vencimiento*</label><br>
          <input type="date" name="fecha_vencimiento" class="form-control" placeholder="Ingrese Fecha Vencimiento"  required ="" ><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Despachado por*</label><br>
          <input type="text" name="despachado_por" class="form-control" placeholder="Ingrese Despachado por"  required =""><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Estado*</label><br>
          <select name="estado" class="custom-select" placeholder="Seleccione Estado"  required ="">
            <option></option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select><br>
        </div>
      </div>
      <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Enviar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
     <a href="listar_pedido.php"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
    </form>

    
<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>

<?php 
if (isset($_POST['submit'])) {
	$pedido->__SET('Persona_id_persona',$_POST['Persona_id_persona']);
	$pedido->__SET('vendedor',$_POST['vendedor']);
	$pedido->__SET('fecha_pedido',$_POST['fecha_pedido']);
	$pedido->__SET('fecha_vencimiento',$_POST['fecha_vencimiento']);
	$pedido->__SET('despachado_por',$_POST['despachado_por']);
	$pedido->__SET('estado',$_POST['estado']);

	if (($pedido->Persona_id_persona == "")&&($pedido->vendedor == "")&&($pedido->fecha_pedido == "")&&($pedido->fecha_vencimiento == "")&&($pedido->despachado_por == "")&&($pedido->estado == ""))  
		{
			 echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar el cliente Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="add_pedido.php"; 
                                      });  
                                </script>';
                                return false;    
		}
	else if ($control->insertar($pedido)) {

                  echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "El cliente ha sido registrado correcto.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="listar_pedido.php"; 
                                });  
                          </script>'; 
                          }else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo registrar el cliente. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="add_pedido.php"; 
                                      });  
                                </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=listar_pedido.php">
<?php 
	}
} ?>

 </div>
	<script type="../../bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="../../bootstrap-3.3.7/js/jquery-3.3.1.min.js"></script>

</body>
</html>

 

<!–data-parsley-required: Hace que el campo sea obligatorio
data-parsley-pattern="^[a-zA-Z ]+$": El patrón solamente acepta caracteres alfabéticos con espacios
data-parsley-length="[6, 10]": Define el tamaño de la cadena. En este caso entre 6 y 10 caracteres
data-parsley-trigger="keyup": Dispara la validación en el evento keyup
data-parsley-equalto="#pass2": Confirma si el valor de dos campos es el mismo especificándole el ID
data-parsley-type="email": Comprueba si el valor es una dirección de email
data-parsley-type="number": Comprueba si el valor es un número
data-parsley-type="alphanum": Comprueba si el valor es alfanumérico

https://programacion.net/articulo/validacion_de_un_formulario_con_parsley_js_1584
–> 
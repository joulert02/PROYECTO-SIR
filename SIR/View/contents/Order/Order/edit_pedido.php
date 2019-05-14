<?php 
require_once '../../../Controller/Order Controller/pedido_controller.php';
require_once '../../../Model/Order Model/pedido_model.php';
$pedido = new Pedido();
$control = new Pedido_Controller();
$resultado=$control->buscar($_GET['id_pedido']);
require "global.php";
require "menu.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="widht=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<title>Agregar Persona</title>

	<link rel="stylesheet" href="../../../Assets/form_bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../Assets/parsley/css/parsley.css"">
    <script src="../../../Assets/js/parsley.js"></script>

</head>
<body>
	<style type="text/css">
    .container{  
     width:900px;
     height: 480px;
</style>
    <br><br>  
	<div class="container card card-body mb-5 mt-5">
		<h2 class="mt-3 ml-2">Editar Pedido</h2>

<form action="#" method="post" id="validate_form" class="ml-2">
	<br>
			<div class="form-row">
				<div class="col-md-4 mb-3">
	     <label>Id Pedido:</label><br>
	<input type="numbre"  class="form-control" name="id_pedido"  value="<?php echo $resultado->id_pedido; ?>"  disabled >  <br>
	</div>
	<div class="col-md-4 mb-3">
	    <label>Id Cliente:</label><br>
	<input type="number"  class="form-control" name="Persona_id_persona" placeholder="nombre" value="<?php echo $resultado->Persona_id_persona; ?>" required="" >  <br>
</div>
    <div class="col-md-4 mb-3">
	<label>Vendedor:</label><br>
	<input type="text"  class="form-control" name="vendedor" placeholder="nombre" value="<?php echo $resultado->vendedor; ?>"  required="" >  <br>
</div>
    <div class="col-md-4 mb-3">
	<label>fecha_pedido:</label><br>
	<input type="date"  class="form-control" name="fecha_pedido" placeholder="nombre" value="<?php echo $resultado->fecha_pedido; ?>" required="" >  <br>
</div>
    <div class="col-md-4 mb-3">
	<label>fecha_vencimiento:</label><br>
	<input type="date"  class="form-control" name="fecha_vencimiento" placeholder="nombre" value="<?php echo $resultado->fecha_vencimiento; ?>" required="" >  <br>
</div>
    <div class="col-md-4 mb-3">
	<label>Despachado Por:</label><br>
	<input type="text"  class="form-control" name="despachado_por" placeholder="nombre" value="<?php echo $resultado->despachado_por; ?>"  required="" >  <br>
</div>
<div class="col-md-4 mb-3">
	<label>Estado:</label><br>
	<select  name="estado" class="custom-select" title="Selecciona Categoria!" required="">
	         <option value="<?php echo $resultado->estado; ?>"></option>   
             <option value="1">Activo</option>
			<option value="0">Inactivo</option>
    </select><br>
</div>
</div>
	<input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
	<input type="reset" value="Limpiar" class="btn btn-secondary">
     <a href="listar_pedido.php"><input type="button" value="Cancelar" class="btn btn-danger"  style="float: right;"></a>
		</form>
<?php 
if (isset($_POST['enviar'])) {
	$pedido->__SET('id_pedido',$_GET['id_pedido']);
	$pedido->__SET('Persona_id_persona',$_POST['Persona_id_persona']);
	$pedido->__SET('vendedor',$_POST['vendedor']);
	$pedido->__SET('fecha_pedido',$_POST['fecha_pedido']);
	$pedido->__SET('fecha_vencimiento',$_POST['fecha_vencimiento']);
	$pedido->__SET('despachado_por',$_POST['despachado_por']);
	$pedido->__SET('estado',$_POST['estado']);
	
	 if ($control->actualizar($pedido)) {

                  echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "El cliente ha sido actualizado correcto.", 
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
                                        text: "No se púdo actualizar el cliente. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="edit_pedido.php"; 
                                      });  
                                </script>';    
		?>
		<meta http-equiv="refresh" content="0; url=listar_pedido.php">
<?php 
	}
}
 ?>

 </div>
	<script type="../../bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="../../bootstrap-3.3.7/js/jquery-3.3.1.min.js"></script>

</body>
</html>
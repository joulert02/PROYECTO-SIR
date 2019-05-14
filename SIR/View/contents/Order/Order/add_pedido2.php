<?php 
require_once '../../../Controller/Order Controller/pedido_controller.php';
require_once '../../../Model/Order Model/Pedido_model.php';
$pedido = new Pedido();
$control = new Pedido_Controller();
require "global.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="widht=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<title>Agregar Persona</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container card card-body mb-5 mt-5">
		<h3 class="mt-3 ml-2">Ingresar nuevo registro</h3>
		<nav class="nav nav-pills flex-column flex-sm-row mb-4 mt-4">
			<a class="flex-sm-fill nav-link active bg-secondary m-1 col-6" href="listar_pedido.php">Volver</a><br>
		</nav>

		<form action="#" method="post" class="ml-2">
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Id Persona</label><br>
					<input type="text" name="Persona_id_persona" class="form-control"  ><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Vendedor</label><br>
					<input type="text" name="vendedor" class="form-control" ><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Fecha Pedido</label><br>
					<input type="date" name="fecha_pedido" class="form-control" ><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Fecha Vencimiento</label><br>
					<input type="date" name="fecha_vencimiento" class="form-control" ><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Despachado por</label><br>
					<input type="text" name="despachado_por" class="form-control" ><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select">
						<option></option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select><br>
				</div>
			</div>

			<input type="submit" name="enviar" class="btn btn-primary" value="Enviar" >
			<input type="reset" value="Limpiar" class="btn">
		</form>
<?php 
if (isset($_POST['enviar'])) {
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
		if ($pedido->Persona_id_persona== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo id persona no puede estar vacio.", 
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

		if ($pedido->vendedor== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo vendedor no puede estar vacio.", 
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
		if ($pedido->fecha_pedido== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo fecha pedido no puede estar vacio.", 
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
		if ($pedido->fecha_vencimiento== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo fecha_vencimiento no puede estar vacio.", 
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
		if ($pedido->despachado_por== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo despachado por no puede estar vacio.", 
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
		if ($pedido->estado== "") {
			echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "El campo estado no puede estar vacio.", 
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
}else{
echo "ingrese los datos y presione el boton enviar";
} ?>

 </div>
	<script type="../../bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="../../bootstrap-3.3.7/js/jquery-3.3.1.min.js"></script>

</body>
</html>
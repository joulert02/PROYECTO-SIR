<?php

require_once "Controller/entryController.php";

require_once 'Controller/productController.php';
$produtoC = new  productoController();

$control = new entryController();
$entrada = new  entryModel();
$productoController = new productoController();
$categoriaController = new  CategoriaController();
$detalleEntrada = $control->buscar();
// var_dump($detalleEntrada);
$fecha = 0;
foreach ($detalleEntrada as $value) {
	$control->insertTmp($value->__GET('Producto_id_producto'),$value->__GET('cantidad'));
	$fecha = date($value->__GET('fecha_entrada'));
}
//echo $fecha;
?>


<script>
	$(document).ready(function() {
		$('#grid').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		$('#tabla').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		$('#tabla2').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			}
		});
	});
</script>


<script type="text/javascript" src="<?php echo SERVERURL; ?>public/lib/alertify.js"></script>
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/themes/alertify.core.css" />
<link rel="stylesheet" href="<?php echo SERVERURL; ?>public/themes/alertify.default.css" />


<br>
<div class="container-fluid">
	<div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">&nbsp&nbsp
				<span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
				<label>
					<h4><b>Editar Entrada</b></h4>
				</label>
			</div>
			<div class="panel-body">
				<form id="validate_form" method="POST">
					<div class="form-row">

						<div class="col-md-6">
							<label>Fecha Entrada</label><br>
							<input type="date" name="fecha_entrada" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>" required class="form-control">

						</div>

						<div class="col-md-6">
							<label>Añadir Productos</label><br>
							<button style="width: 100%;" type="button" id="cargarP" class="btn btn-info" data-toggle="modal" data-target="#exampleModalScrollable">
								<span class="glyphicon glyphicon-plus"></span> Agregar productos
							</button><br>
						</div>



						<div class="col-md-10 col-xs-12 col-md-offset-1 mt-1" style="margin-top: 5%">
							<center>
								<h4>Productos registrados en la entrada</h4>
							</center>
							<div class="table-responsive">
								<table id=".grid" class="table table-striped table-bordered nowrap" style="width:100%">
									<thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
										<tr>

											<td scope="col">Referencia</td>
											<td scope="col">Nombre Producto</td>
											<td scope="col" width="15%">Cantidad</td>
											<td scope="col">Acciones</td>
										</tr>
									</thead>
									<tbody id="insumo">

									</tbody>
								</table>
							</div>




							<!-- <div class="table-responsive" style="margin-top: 5%">
								<center>
									<h4>Productos Añadidos a la entrada</h4>
								</center>
								<table class="table table-striped table-bordered nowrap" style="width:100%">
									<thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
										<tr>
											<th width="2%">Referencia</th>
											<th width="10%">Nombre</th>
											<th width="1%">Cantidad</th>
											<th width="1%">Eliminar</th>
										</tr>
									</thead>
									<tbody id="">

									</tbody>
								</table>
							</div> -->


						</div>
						<!-- Modal -->
						<div class="modal fade bs-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>


										<center>
											<h2 class="modal-title" id="exampleModalScrollableTitle">Productos</h2>
										</center>
									</div>

									<div class="modal-body">
										<div class="container-fluid">
											<div class="table-responsive">
												<table id="tabla" class="table table-striped table-bordered nowrap" style="width:100%">
													<thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
														<tr>
															<!--<td width="5%">Id Producto</td>-->
															<td width="5%">Referencia</td>
															<td width="10%">Nombre Producto</td>
															<td width="5%">Cantidad</td>
															<td width="1%">Agregar</td>

														</tr>
													</thead>

													<tbody id="product">
														<?php foreach ($produtoC->listar() as $r) : ?>
															<tr Producto_id_producto="<?php echo $r->__GET('id_producto'); ?>" valor="<?php echo $r->__GET('cantidad'); ?>" tipo="2">
																<!-- <td> <?php echo $r->__GET('id_producto'); ?> </td> -->
																<td> <?php echo $r->__GET('referencia'); ?> </td>
																<td> <?php echo $r->__GET('nombre_producto'); ?> </td>


																<td>
																	<input type="number" style="width:60%;" class="form-control" id="cantidad_<?php echo $r->__GET('id_producto'); ?>" value="1">
																</td>
																<td>
																	<button class="btn btn-primary text-center" id="insertarP"><i class="glyphicon glyphicon-plus"></i></button>
																</td>


															</tr>
														<?php endforeach; ?>
													</tbody>

												</table>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin Modal -->



						<div class="col-md-12 mb-3">
							<input type="submit" value="Actualizar" name="registrar" class="btn btn-info">
							<a href="<?php echo SERVERURL; ?>listEntry"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		$('#validate_form').parsley();
	});
</script>


<script src="http://localhost:8080/PROYECTO-SIR/SIR/ajax/Entrada.js"></script>

<script>
	jQuery(document).ready(function($) {
		$('.delete').on('click', function() {
			var getLink = $(this).attr('href');
			swal({
				title: 'Estás seguro de eliminar este registro de la entrada?',
				text: "Será eliminado permanentemente!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, eliminar!',
				closeOnConfirm: false
			}, function() {
				swal("¡Eliminado!",
					"Eliminado Correctamente.",
					"success", );
				window.location.href = getLink
			});
			return false;
		});
	});
</script>



<?php
if (isset($_POST["registrar"])) {

	$entrada->__SET('fecha_entrada',  $_POST['fecha_entrada']);

	//$entrada->__SET('cantidadP', $_SESSION['cantidadp']);
	if (($entrada->fecha_entrada == "")) {
		echo '<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: true 
                                      }, 
                                      function(){ 
                                        window.location.href="' . SERVERURL . 'editEntry"; 
                                      });  
                                </script>';
		return false;
	} else if ($control->actualizar($entrada)) {
		echo '<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "La Entrada ha sido actualizada correctamente.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: true 
                                }, 
                                function(){ 
                                });  
                          </script>';
	} else {

		echo '<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                      });  
                                </script>';
		?>
	<?php
}
} ?>
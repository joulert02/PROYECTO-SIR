<?php
require_once 'Controller/productController.php';
$produtoC = new  productoController();
include_once "Controller/entryController.php";
$entrada = new entryModel();
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


<script type="text/javascript" src="public/lib/alertify.js"></script>
<link rel="stylesheet" href="public/themes/alertify.core.css" />
<link rel="stylesheet" href="public/themes/alertify.default.css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />




<br>
<div class="container-fluid">
	<div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">&nbsp&nbsp
				<span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
				<label>
					<h4><b>Nueva Pedido</b></h4>
				</label>
			</div>
			<div class="panel-body">

				<form id="datos_pedido" method="POST">

					<div class="form-row">

						<div class="col-md-4">
							<label for="proveedor" class="control-label">Selecciona el cliente</label>
							<select class="proveedor form-control" name="proveedor" id="proveedor" required><br>
							</select>
						</div>

						<div class="col-md-4">
							<label for="transporte" class="control-label">Transporte</label>
							<input type="text" class="form-control " id="transporte" value="Recogido" required><br>
						</div>

						<div class="col-md-4">
							<label for="condiciones" class="control-label">N° Comprobante</label>
							<input type="number" class="form-control " id="condiciones" value="500" required><br>
						</div>

						<div class="col-md-4">
							<label for="condiciones" class="control-label">Estado</label><br>
							<select id="estado" class="form-control" required="">
								<option value="" selected disabled>Seleccione Estado</option>
								<option value="1">Pendiente</option>
								<option value="0">Pago</option>
							</select>
						</div>

						<div class="col-md-4">
							<label for="descuento" class="control-label">Descuento</label><br>
							<select id="descuento" class="form-control" required="">
								<option value="" selected disabled>Seleccione Descuento</option>
								<option value="0">0%</option>
								<option value="5">5%</option>
								<option value="10">10%</option>
							</select>
						</div>

						<div class="col-md-4">
							<label>Productos</label><br>
							<button style="width: 100%;" type="button" id="cargarP" class="btn btn-info" data-toggle="modal" data-target="#exampleModalScrollable">
								<span class="glyphicon glyphicon-plus"></span> Agregar productos
							</button>
						</div>
					</div>
					<br><br>

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
											<table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
												<thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
													<tr>
														<!--<td width="5%">Id Producto</td>-->
														<td width="5%">Referencia</td>
														<td width="10%">Nombre Producto</td>
														<td width="5%">Precio Unitario</td>
														<td width="5%">Cantidad</td>
														<td width="1%">Agregar</td>

													</tr>
												</thead>

												<tbody id="product">
													<?php foreach ($produtoC->listar() as $r) : ?>
														<tr>
															<!--  <td> <?php echo $r->__GET('id_producto'); ?> </td>-->
															<td> <?php echo $r->__GET('referencia'); ?> </td>
															<td> <?php echo $r->__GET('nombre_producto'); ?> </td>
															<td> <?php echo $r->__GET('precio_unitario'); ?> </td>
															<td> </td>
															<td> </td>


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
					<center>
						<div class="container-fluid" style="margin-top: 15%">
							<div class="table-responsive">
								<table class="table table-striped table-bordered nowrap" style="width:80%">
									<thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
										<tr>
											<th width="2%">Referencia</th>
											<th width="10%">Nombre</th>
											<th width="1%">Cantidad</th>
											<th width="1%">Precio Unitario</th>
											<th width="1%">Sub Total</th>
											<th width="1%">Eliminar</th>
										</tr>
									</thead>
									<tbody id="insumo">

									</tbody>
									<tr>
										<td colspan=4><span class="pull-right ">TOTAL $</span></td>
										<td><span class="pull-right" id="totall">
												<!--<input style="border:0"  readonly="readonly"  name="sub_total" value="150000"--> </span></td>
									</tr>
								</table>
							</div>
						</div>
					</center>




					<div class="col-md-12 mb-3">
						<input type="submit" value="registrar" name="registrar" class="btn btn-info">
						<a href="<?php echo SERVERURL; ?>listEntry"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		$('#datos_pedido').parsley();
	});
</script>



<script type="text/javascript">
	$("#datos_pedido").submit(function(e) {
		e.preventDefault();
		var proveedor = $("#proveedor").val();
		var transporte = $("#transporte").val();
		var descuento = $("#descuento").val();
		var comentarios = $("#comentarios").val();
		var estado = $("#estado").val();
		var total= document.getElementById("totall");
		var total = total.innerHTML;
		if (parseInt(total) < 200000 || proveedor<=0) {
				if (proveedor<=0) {
					swal({
              title: 'precaución',
              text: 'Debes seleccionar cliente',
              type: 'warning',
              confirmButtonText: 'Aceptar',
          },
          function(){
              
          });
				} else {
					swal({
              title: 'precaución',
              text: 'El pedido Debe ser mayor a 200.000 (doscientos mil pesos)',
              type: 'warning',
              confirmButtonText: 'Aceptar',
          },
          function(){
              
          });
				}
			} else {
				VentanaCentrada('View/contents/reportPedido-view.php?proveedor=' + proveedor + '&estado=' + estado + '&transporte=' + transporte + '&descuento=' + descuento + '&comentarios=' + comentarios, 'Pedido', '', '1024', '768', 'true');
				return false;
			}


	});
</script>
</script>




<script type="text/javascript">
	$(document).ready(function() {
		$(".proveedor").select2({
			ajax: {
				url: "ajax/load_proveedores.php",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						q: params.term // search term
					};
				},
				processResults: function(data) {
					return {
						results: data
					};
				},
				cache: true
			},
			minimumInputLength: 2
		});
	});
</script>


<script src="http://localhost:8080/PROYECTO-SIR/SIR/ajax/Pedido.js"></script>
<script type="text/javascript" src="public/js/VentanaCentrada.js"></script>
<script src="public/js/select2.min.js"></script>






<?php
/*
    if (isset($_POST["registrar"])) {


$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta = $conec->prepare("SELECT * FROM tmp_entrada");
$Consulta ->  execute();
$contarRegistros = $Consulta -> fetchAll();
if ($CantidadPersonas = (count($contarRegistros)==0)) {
  echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                         text: "No hay productos agregados al pedido", 
                                         type:"error", 
                                         confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addOrder"; 
                                       });  
                                 </script>';
                                 return false;    
}


     
  
  }*/
?>
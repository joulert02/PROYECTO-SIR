<?php 
require_once '../../../Controller/Order Controller/pedido_detalle_controller.php';
require_once '../../../Model/Order Model/pedido_detalle_model.php';
$pedido = new PedidoDetalle();
$control = new Pedido_Detalle_Controller();
?>

<meta charset="utf-8">
	<meta name="viewport" content="widht=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<title>Agregar Persona</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container card card-body mb-5 mt-5">
		<h3 class="mt-3 ml-2">Ingresar nuevo registro</h3>
		<nav class="nav nav-pills flex-column flex-sm-row mb-4 mt-4">
			<a class="flex-sm-fill nav-link active bg-secondary m-1 col-6" href="listar_pedido_detalle.php">Volver</a><br>
		</nav>

		<form action="#" method="post" class="ml-2">
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Id Pedido</label><br>
					<input type="text" name="Pedido_id_pedido" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Id Producto</label><br>
					<input type="text" name="Producto_id_producto" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Cantidad</label><br>
					<input type="text" name="cantidad" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Precio</label><br>
					<input type="text" name="precio" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Sub Total 1</label><br>
					<input type="text" name="sub_total1" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Descuento</label><br>
					<input type="text" name="descuento" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Sub Total 2</label><br>
					<input type="text" name="sub_total2" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Iva Total</label><br>
					<input type="text" name="iva_total" class="form-control" required=""><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Total Pagar</label><br>
					<input type="text" name="total_pagar" class="form-control" required=""><br>
				</div>
			</div>

			<input type="submit" name="enviar" class="btn btn-primary" value="Enviar" class="btn">
			<input type="reset" value="Limpiar" class="btn">
		</form>
<?php 
if (isset($_POST['enviar'])) {
	$pedido->__SET('Pedido_id_pedido',$_POST['Pedido_id_pedido']);
	$pedido->__SET('Producto_id_producto',$_POST['Producto_id_producto']);
	$pedido->__SET('cantidad',$_POST['cantidad']);
	$pedido->__SET('precio',$_POST['precio']);
	$pedido->__SET('sub_total1',$_POST['sub_total1']);
	$pedido->__SET('descuento',$_POST['descuento']);
	$pedido->__SET('sub_total2',$_POST['sub_total2']);
	$pedido->__SET('iva_total',$_POST['iva_total']);
	$pedido->__SET('total_pagar',$_POST['total_pagar']);
	if ($control->insertar($pedido)) {
		echo "datos  ingresados con exito";
		?>
		<meta http-equiv="refresh" content="0; url=listar_pedido_detalle.php">
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
<?php 
require_once '../../../Controller/Order Controller/pedido_detalle_controller.php';
require_once '../../../Model/Order Model/pedido_detalle_model.php';
$pedido = new PedidoDetalle();
$control = new Pedido_Detalle_Controller();
$resultado=$control->buscar($_GET['Pedido_has_Producto']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	<title>mc2 actualizar</title>
</head>
<body>
<div class="container">
<a href="listar_pedido_detalle.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">home</a><br>

<center>

<h3>Editar Pedido al  actualizar</h3>

</center>
<form action="#" method="post">
	     <label>Id Pedido Detalle:</label>
	<input type="numbre"  class="form-control" name="Pedido_has_Producto"  value="<?php echo $resultado->Pedido_has_Producto; ?>"  disabled >  <br>
	    <label>Id Pedido:</label>
	<input type="number"  class="form-control" name="Pedido_id_pedido" placeholder="nombre" value="<?php echo $resultado->Pedido_id_pedido; ?>"   required>  <br>
	<label>Id Producto:</label>
	<input type="number"  class="form-control" name="Producto_id_producto" placeholder="nombre" value="<?php echo $resultado->Producto_id_producto; ?>"   required>  <br>
	<label>cantidad:</label>
	<input type="number"  class="form-control" name="cantidad" placeholder="nombre" value="<?php echo $resultado->cantidad; ?>"   required>  <br>
	<label>precio:</label>
	<input type="number"  class="form-control" name="precio" placeholder="nombre" value="<?php echo $resultado->precio; ?>"   required>  <br>
	<label>Sub Total 1:</label>
	<input type="number"  class="form-control" name="sub_total1" placeholder="nombre" value="<?php echo $resultado->sub_total1; ?>"   required>  <br>
	<label>Descuento:</label>
	<input type="number"  class="form-control" name="descuento" placeholder="nombre" value="<?php echo $resultado->descuento; ?>"   required>  <br>
	<label>Sub Total 2:</label>
	<input type="number"  class="form-control" name="sub_total2" placeholder="nombre" value="<?php echo $resultado->sub_total2; ?>"   required>  <br>
	<label>iva Total:</label>
	<input type="number"  class="form-control" name="iva_total" placeholder="nombre" value="<?php echo $resultado->iva_total; ?>"   required>  <br>
	<label>Total Pagar:</label>
	<input type="number"  class="form-control" name="total_pagar" placeholder="nombre" value="<?php echo $resultado->total_pagar; ?>"   required>  <br>
  <br>
	<input type="submit" name="enviar" class="btn btn-primary" value="enviar">
</form>
<?php 
if (isset($_POST['enviar'])) {
	$pedido->__SET('Pedido_has_Producto',$_GET['Pedido_has_Producto']);
	$pedido->__SET('Pedido_id_pedido',$_POST['Pedido_id_pedido']);
	$pedido->__SET('Producto_id_producto',$_POST['Producto_id_producto']);
	$pedido->__SET('cantidad',$_POST['cantidad']);
	$pedido->__SET('precio',$_POST['precio']);
	$pedido->__SET('sub_total1',$_POST['sub_total1']);
	$pedido->__SET('descuento',$_POST['descuento']);
	$pedido->__SET('sub_total2',$_POST['sub_total2']);
	$pedido->__SET('iva_total',$_POST['iva_total']);
	$pedido->__SET('total_pagar',$_POST['total_pagar']);

	if ($control->actualizar($pedido)) {
		echo "datos  actualizados con exito";
		?>
		<meta http-equiv="refresh" content="0; url=listar_pedido_detalle.php">
<?php 
	}
}else{
echo "ingrese los datos nuevos y presione el boton enviar";
} ?>

</center>
 </div>
	<script type="../../bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="../../bootstrap-3.3.7/js/jquery-3.3.1.min.js"></script>
</body>
</html>
<?php 
require_once '../../../Controller/Order Controller/pedido_detalle_controller.php';
$control = new Pedido_Detalle_Controller();
if ($control->eliminar($_GET['Pedido_has_Producto'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=listar_pedido_detalle.php">
<?php  }?>



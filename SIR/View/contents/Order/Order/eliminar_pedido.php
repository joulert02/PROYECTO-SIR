<?php 
require_once '../../../Controller/Order Controller/pedido_controller.php';
$control = new Pedido_Controller();
if ($control->eliminar($_GET['id_pedido'])) {
	 ?>
	<meta http-equiv="refresh" content="0; url=listar_pedido.php">

<?php  
}?>




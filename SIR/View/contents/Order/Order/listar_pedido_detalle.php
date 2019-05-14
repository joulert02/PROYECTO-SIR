<?php  
require_once "../../../Controller/Order Controller/pedido_detalle_controller.php";
$control = new  Pedido_Detalle_Controller();
?>

<html>
<head>
  <meta name="viewport" content="width=device-width" />
  <title>Rodillos Mastder</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

  
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
  
</head>
<body>
  
<script>
$(document).ready(function() {
  $('#grid').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
    </script>
    <br><br><br><br>
    <center>
    <h1>Consultar Pedido Detalle</h1>
     <br><br><a href="add_pedido_detalle.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">Agregar Nuevos Registros</a>
     <a href="listar_pedido.php" class="btn btn-primary" role="button" style="font-family: 'Gill Sans','Gill Sans MT',sans-serif">Consultar Pedido Detalle</a>
    </center>
    <div class="container">
        <table id="grid" class="table table-striped table-bordered "style="width:100%" >
            <thead style="background-color: #dc3545;color: white; font-weight: bold;">
                <tr>
				                <td width="5%">Id Producto</td>
                                <td width="5%">Id Pedido</td>
                                <td width="5%">Id Producto</td>
                                <td width="5%">Cantidad</td>
                                <td width="10%">Precio</td>
                                <td width="10%">Sub Total 1</td>
                                <td width="10%">Descuento</td>
                                <td width="10%">Sub Total 2</td>
                                <td width="10%">Iva Total</td>
                                <td width="10%">Total Pagar</td>
                                <td width="10%">ACTUALIZAR</td>
                </tr>
            </thead>

        <tbody>
            <tr>
			<?php foreach ($control->ListaDatos() as $r):?>
								<td> <?php echo $r->__GET('Pedido_has_Producto'); ?> </td>
                                <td> <?php echo $r->__GET('Pedido_id_pedido'); ?> </td>
                                <td> <?php echo $r->__GET('Producto_id_producto'); ?> </td>
								<td> <?php echo $r->__GET('cantidad');?> </td>
								<td> <?php echo $r->__GET('precio'); ?> </td>
                                <td> <?php echo $r->__GET('sub_total1'); ?> </td>
								<td> <?php echo $r->__GET('descuento');?> </td>
                                <td> <?php echo $r->__GET('sub_total2'); ?> </td>
								<td> <?php echo $r->__GET('iva_total'); ?> </td>
                                <td> <?php echo $r->__GET('total_pagar'); ?> </td>
								<th>
								<a href="../../../View/Order/Order/edit_pedido_detalle.php?Pedido_has_Producto=<?php echo $r->Pedido_has_Producto; ?>">editar</a>
								<a href="../../../View/Order/Order/eliminar_pedido_detalle.php?Pedido_has_Producto=<?php echo $r->Pedido_has_Producto; ?>">eliminar</a>
								</th>
            </tr>
			<?php endforeach; ?> 
        </tbody>

    </table>
</div>
  
</body>
</html>
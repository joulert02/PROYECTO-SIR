<?php 
require_once "Model/pedidoModel.php";
require_once "Controller/personController.php";
$persona = new personController();
//CONEXION
	$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
	// set the PDO error mode to exception
	$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
  $datopedido=array();
	$consulta="SELECT * FROM tbl_pedido ORDER BY id_pedido ";
		$resultado=$conec->prepare($consulta);
		$resultado->execute();
		foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
			$pedido = new pedidoModel();
			$pedido->__SET('id_pedido',$datos->id_pedido);
			$pedido->__SET('Persona_id_persona',$datos->Persona_id_persona);
			$pedido->__SET('vendedor',$datos->vendedor);
			$pedido->__SET('fecha_pedido',$datos->fecha_pedido);
			$pedido->__SET('fecha_vencimiento',$datos->fecha_vencimiento);
			$pedido->__SET('despachado_por',$datos->despachado_por);
			$pedido->__SET('estado',$datos->estado);
			$datopedido[]=$pedido;
    }
?>
<script>
$(document).ready(function() {
  $('#grid').DataTable({
    "order": [[ 0, "desc" ]],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>

<style type="text/css">

  .container 
 {  
 width:950px;
 height: 400px;
 position: relative;
}

#modal_size{
      width: 25%;
    }

    </style>
    <center>

    <h1>Pedidos</h1>
      </center>

         <div class="container-fluid" style="width: 90%;">
           <hr>
          <a href="<?php echo SERVERURL; ?>addPedido" class="btn btn-primary" role="button">Registrar Pedido &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
          

          <br><br>
        <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
                <tr>
                                <td style="display: none" >Id Pedido</td> 
                                <td >Vendedor</td>
                                <td >Fecha Pedido</td>
                                <td >Fecha Vencimiento</td>
                                <td >Cliente</td>
                                <td >Despachado Por</td>
                                <td >Estado</td>
                                <td >Acciones</td>
                </tr>
            </thead>

        <tbody>
      <?php foreach ($datopedido as $r):
        $personaResult = $persona->buscar($r->__GET('Persona_id_persona'));
          ?>
        <tr iddetalle="<?php echo $r->__GET('id_pedido'); ?>">
          <td style="display: none"> <?php echo $r->__GET('id_pedido'); ?> </td> 
          <td> <?php echo $r->__GET('vendedor'); ?> </td>
                          <td> <?php echo $r->__GET('fecha_pedido'); ?> </td>
          <td> <?php echo $r->__GET('fecha_vencimiento');?> </td>
          <td> <?php echo $personaResult->__GET('nombres')." ".$personaResult->__GET('apellidos'); ?></td>
          <td> <?php echo $r->__GET('despachado_por'); ?> </td>
          <td> <?php $estado = ($r->__GET('estado')==1) ? "Pendiente" : "Pago";  echo $estado; ?> </td>
          <td>
            <a href="edit_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Editar" class='btn btn-primary' ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
            <a href="#" class="btn btn-primary mostrarDetalle" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye" aria-hidden="true"></i></a> 
            <a href="View/contents/voucherOrder-view.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Comprobante" class="btn btn-primary" target="_blank" role="button"><i class="fa fa-file" aria-hidden="true"></i></a>
            <!-- <a href="eliminar_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Eliminar" class='btn btn-danger delete' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a> -->
           </td>
        </tr>
      <?php endforeach; ?> 
        </tbody>

    </table>
</div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
        <h4 class="modal-title" id="myModalLabel">Informacion De La Entrada</h4>
      </center>
      </div>
      <div class="modal-body">

      <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
			      <td scope="col" style="display: none">ID Entrada</td>
			      <td scope="col">Nombre Producto</td>
			      <td scope="col">Referencia</td>
			      <td scope="col">Cantidad</td>
			      <!-- <td scope="col">Acciones</td> -->
		        </tr>
		    </thead>
        <tbody id="detalle">
        
        </tbody>
        </table>
      <div class="modal-footer">
       <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </center>
      </div>
      </div>
    </div>
  </div>

<script>
       jQuery(document).ready(function($){
            $('.mostrarDetalle').on('click',function(){
              let element = $(this)[0].parentElement.parentElement;
              let id = $(element).attr('iddetalle');
              const postData = {
                  id : id,
               }
               $.post('http://localhost/SIR/Controller/pedidoController.php', postData, function(response) {
                  console.log(response);
                  let productos = JSON.parse(response);
                  let template = '';
                  productos.forEach(productos => {
                      template += `
                          <tr>
                          <td>${productos.nombre_producto}</td>
                          <td>${productos.referencia}</td>
                          <td>${productos.cantidad}</td>
                          </tr>
                      `;
                  });
                  $('#detalle').html(template);
                });
            });
        });
    </script>
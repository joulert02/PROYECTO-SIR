<?php
	// include_once ("../model/config.php");
	// $cnx = new conexion();
	// $cnx->conectar();

	require_once "Controller/entryController.php";
	$control = new entryController();
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
    <h1>Entradas</h1>
      </center>

         <div class="container-fluid" style="width: 90%;">
           <hr>
          <br><a href="<?php echo SERVERURL; ?>addEntry" class="btn btn-primary" role="button">Registrar Entrada &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
          </a>

           <a href="View/contents/reportEntry-view.php" class="btn btn-primary" target="_blank" style="float: right;" role="button">Reporte &nbsp&nbsp<i class="fa fa-file"></i></a>
           <br><br>

       <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
			<td scope="col" style="display: none">ID Entrada</td>
			<!-- <td scope="col">Nombre Producto</td> -->
			<!-- <td scope="col">Referencia</td> -->
			<!-- <td scope="col">Cantidad</td> -->
			<td scope="col">Fecha Entrada</td>
			<td scope="col">Acciones</td>
		</tr>
		</thead>
		<tbody>
			<?php $contador=1; foreach ($control->listar() as $fila):
        ?>
        <tr idDetalle="<?php echo $fila->Entrada_id_entrada; ?>">
          <td scope="row" style="display: none"><?php echo $fila->Entrada_id_entrada; ?></td>
          <!-- <td><?php //echo $fila->nombre_producto; ?></td> -->
          <!-- <td><?php //echo $fila->referencia; ?></td> -->
          <!-- <td><?php //echo $fila->cantidad; ?></td> -->
          <td><?php echo $fila->fecha_entrada; ?></td>
          <td>
          <a href="<?php echo SERVERURL; ?>editEntry?id=<?php echo $fila->Entrada_id_entrada; ?>" title="Editar" class='btn btn-primary' ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
            <?php $_SESSION['id'.$contador]=$fila->Entrada_id_entrada;
            $contador++;
            ?>
            <a href="#" class="btn btn-primary mostrarDetalle" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye" aria-hidden="true"></i></a> 
          </td>
      </tr>
      <?php endforeach; ?> 
        </tbody>
    </table>
  </div>

 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
        <h4 class="modal-title" id="myModalLabel">Informacion De Pedido</h4>
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
               console.log(postData);
               $.post('http://localhost:8080/PROYECTO-SIR/SIR/Controller/entryController.php', postData, function(response) {
                  console.log(response);
                  let productos = JSON.parse(response);
                  let template = '';
                  productos.forEach(productos => {
                      template += `
                          <tr>
                          <td>${productos.nombre_producto}</td>
                          <td>${productos.referencia}</td>
                          <td>${productos.cantidad}</td>
                          <td>${productos.fecha_entrada}</td>
                          </tr>
                      `;
                  });
                  $('#detalle').html(template);
                });
            });
        });
    </script>
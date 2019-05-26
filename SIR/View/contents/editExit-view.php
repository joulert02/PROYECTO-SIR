<?php
	require_once "Controller/exitController.php";
	require_once 'Controller/productController.php';
	$control = new exitController();
	$salida = new  exitModel();
	$produtoC = new productoController();
	$productoController = new productoController();		
	$categoriaController = new  CategoriaController();
	$tipoSalida = new tipoSalidaModel();
	$detalleSalida=$salida->buscar();

	$fecha=0;
  foreach ($detalleSalida as $value) {
    $fecha= date($value->__GET('fecha_salida'));
  }
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


<script type="text/javascript" src="public/lib/alertify.js"></script>
    <link rel="stylesheet" href="public/themes/alertify.core.css" />
    <link rel="stylesheet" href="public/themes/alertify.default.css" />


    <br>
  <div class="container-fluid">
    <div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
              <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Salida</b></h4></label>
          </div>
      <div class="panel-body"> 
        <form id="validate_form" method="POST" >
     <div class="form-row">

      	<div class="col-md-4">
        <label>Fecha Salida</label><br>
        <input type="date" name="fecha_entrada" value="<?php echo date('Y-m-d', strtotime($fecha));?>"required class="form-control">
        
      </div>

      <div class="col-md-4">
				<label>Tipo Salida</label><br>
				<select name="tipo_salida_tipo_salida" class="custom-select form-control" required>
	 				<option value="true" disabled>Seleccione tipo Salida</option>
					 <?php
					//  foreach ($tipoSalida->consultarTipoSalida() as $dato) {
					// 	 if ($dato->tipo_salida==$detalleSalida->__GET('tipo_salida_tipo_salida')) {
					// 		echo '<option value="'.$detalleSalida->__GET('tipo_salida_tipo_salida').'" selected>'.$dato->nombre.'</option>;';
					// 	 }else{
					// 		echo '<option value="'.$dato->tipo_salida.'">'.$dato->nombre.'</option>;';
					// 	 }
					//  }
					 ?>
				</select>
			</div>

      <div class="col-md-4">
          <label>Añadir Productos</label><br>
        <button style="width: 100%;" type="button" id="cargarP" class="btn btn-info" data-toggle="modal" data-target="#exampleModalScrollable">
             <span class="glyphicon glyphicon-plus"></span> Agregar productos
            </button><br>
      </div>

      

           <div class="col-md-10 col-xs-12 col-md-offset-1 mt-1" style="margin-top: 5%">     
<center>           
<h4 >Productos registrados en la salida</h4>
</center>
<div class="table-responsive">
<table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
			      
			      <td scope="col">Referencia</td>
			      <td scope="col">Nombre Producto</td>
			      <td scope="col" width="15%">Cantidad</td>
			      <td scope="col">Acciones</td>
		        </tr>
		    </thead>
        <tbody>
          <?php
        foreach ($detalleSalida as $producto): 
          $result= $productoController->buscar($producto->__GET('Producto_id_producto')); ?>
		<tr>
    
          <td><?php echo $result->referencia; ?></td>
          <td><?php echo $result->nombre_producto; ?></td>
          <td><input type="number" name="cantidad" class="form-control" value="<?php echo $producto->__GET('cantidad'); ?>"></td>
          <td><a href="view/contents/deleteComment-view.php?id=<?php echo $fila->id_comentario; ?>" title="Eliminar" class='btn btn-danger delete' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a></td>

		</tr>
    <?php endforeach; ?>
	</tbody>
       </table>
     </div>
     
    


                    <div class="table-responsive" style="margin-top: 5%">
                      <center>           
<h4 >Productos Añadidos a la salida</h4>
</center>
        <table   class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
            <tr>
            <th width="2%">Referencia</th>
            <th width="10%">Nombre</th>
            <th width="1%">Cantidad</th>
            <th width="1%">Eliminar</th>
            </tr>
          </thead>
          <tbody id="insumo">
          
          </tbody>
          </table>
        </div>
      
       
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
      <?php foreach ($produtoC->listar() as $r):?>
        <tr>
      <!--  <td> <?php echo $r->__GET('id_producto'); ?> </td>-->
        <td> <?php echo $r->__GET('referencia');?> </td>
                <td> <?php echo $r->__GET('nombre_producto');?> </td>
                
                
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
      <!-- Fin Modal -->
                


    <div class="col-md-12 mb-3">
      <input type="submit" value="Actualizar" name="registrar" class="btn btn-info">
        <a href="<?php echo SERVERURL; ?>listExit"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
    </div>
  </form>
</div>
</div>
</div>
</div>


  
  <script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>


 <script src="http://localhost:8080/PROYECTO-SIR/SIR/ajax/Salida.js"></script>

<script>
        jQuery(document).ready(function($){
            $('.delete').on('click',function(){
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
                        },function(){
                          swal("¡Eliminado!", 
                         "Eliminado Correctamente.", 
                         "success",); 
                        window.location.href = getLink
                    });
                return false;
            });
        });
    </script>

 

 <?php
    if (isset($_POST["registrar"])) {
     
       $entrada->__SET('fecha_entrada',  $_POST['fecha_entrada']);

      $entrada->__SET('entrada_has_prducto', $detalleSalida->__GET('entrada_has_prducto'));
      $entrada->__SET('cantidad', $_POST["cantidad"]);
      //$entrada->__SET('cantidadP', $_SESSION['cantidadp']);
    if (($entrada->fecha_entrada == "")&&($entrada->cantidad == "")&&($entrada->Producto_id_producto == ""))  
    {
       echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada Revise los campos.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'editEntry"; 
                                      });  
                                </script>';
                                return false;    
    }
      else if ($control->actualizar($entrada)) {
                  echo'<script type="text/javascript"> 
                            swal({title: "LISTO",    
                                  text: "La Entrada ha sido actualizada correctamente.", 
                                  type:"success", 
                                  confirmButtonText: "OK", 
                                  closeOnConfirm: false 
                                }, 
                                function(){ 
                                  window.location.href="'.SERVERURL.'listEntry"; 
                                });  
                          </script>'; 
                          }
                          else{ 

                          echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                        text: "No se púdo actualizar la Entrada. Intenta más tarde.", 
                                        type:"error", 
                                        confirmButtonText: "OK", 
                                        closeOnConfirm: false 
                                      }, 
                                      function(){ 
                                        window.location.href="'.SERVERURL.'listEntry"; 
                                      });  
                                </script>';    
    ?>
<?php 
  }
} ?>
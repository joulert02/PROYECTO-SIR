

<style type="text/css">
  .container{  
    width:700px;
    height: 415px;
  }
</style>

    <br>
	<div class="container">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Entrada</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form action="" id="validate_form" method="POST" class="form-horizontal">
	
		<div class="row">
			<div class="col-md-4">
				<label class="control-label">Fecha Entrada</label><br>
				<input type="date" name="fecha_entrada" value="<?php echo date("Y-m-d");?>"required class="form-control input-sm">
			</div>

		</div><br><br>
         



         <h3 class="h3">Productos:</h3>
			<!-- Button trigger modal -->
				<button type="button" id="cargarP" class="btn-sm pt-0 pb-0 btn-primary" style="height: 40px; margin:auto" data-toggle="modal" data-target="#exampleModalScrollable">
				Insertar Productos
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle">Mostrar Productos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
						<thead style="background-color: #dc3545;color: white; font-weight: bold;">
							<tr>
							<td width="10%">Nombre</td>
							<td width="10%">Cantidad</td>
							<td width="10%">Acciones</td>
							</tr>
						</thead>
						<tbody id="product">
						
						</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>
				</div>
				<table class="table">
					<thead>
						<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Cantidad</th>
						</tr>
					</thead>
					<tbody id="insumo">
					
					</tbody>
					</table>






		<div class="col-md-12">
			
      <input type="reset" value="Limpiar" class="btn btn-secondary">
      <a href="<?php echo SERVERURL; ?>listEntry"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
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


 <script src="http://localhost/SIR/ajax/Entrada.js"></script>




 

 <?php
		if (isset($_POST["registrar"])) {
			$entrada->__SET('Producto_id_producto', $_SESSION['id_producto']);
			$entrada->__SET('fecha_entrada',  $_SESSION['fecha_entrada']);
			$entrada->__SET('cantidad', $_POST["cantidad"]);
			$entrada->__SET('cantidadP', $_SESSION['cantidadp']);
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
                                         window.location.href="'.SERVERURL.'addEntry"; 
                                       });  
                                 </script>';
                                 return false;    
		}
	else if ($control->insertar($entrada)) {

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
                                         window.location.href="'.SERVERURL.'addEntry"; 
                                       });  
                                 </script>';    
		 ?>
		 <meta http-equiv="refresh" content="0; url=http://localhost/SIR/listEntry"> 
<?php 
	}
} ?>
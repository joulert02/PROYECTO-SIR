
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

<script type="text/javascript" src="public/lib/alertify.js"></script>
		<link rel="stylesheet" href="public/themes/alertify.core.css" />
		<link rel="stylesheet" href="public/themes/alertify.default.css" />


    <br>
	<div class="container-fluid">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Entrada</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form id="validate_form" method="POST" >
	   
		<div class="form-row">
			<div class="col-md-6">
				<label>Fecha Entrada</label><br>
				<input type="date" name="fecha_entrada" value="<?php echo date("Y-m-d");?>"required class="form-control">
			</div>

         <div class="col-md-6">
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
                    <td width="5%">Cantidad</td> 
                    <td width="1%">Agregar</td> 

                </tr>
            </thead>

        <tbody id="product">
			<?php foreach ($produtoC->listar() as $r):?>
    		<tr>
			<!--	<td> <?php echo $r->__GET('id_producto'); ?> </td>-->
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
		        <br><br><br>
                  <center>
				<table class="table table-striped table-bordered nowrap" style="width:55%">
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
$(document).ready(function(){  
    $('#validate_form').parsley();
});  
</script>


 <script src="http://localhost/SIR/ajax/Entrada.js"></script>




 

 <?php
		if (isset($_POST["registrar"])) {


$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta = $conec->prepare("SELECT * FROM tmp_entrada");
$Consulta ->  execute();
$contarRegistros = $Consulta -> fetchAll();
if ($CantidadPersonas = (count($contarRegistros)==0)) {
	echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                         text: "No hay productos agregados a la entrada", 
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
//$CantidadPersonas = (count($contarRegistros)==0);
//alert("no hay productos agregados "); 

			
			$entrada->__SET('fecha_entrada',  $_POST['fecha_entrada']);
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
	else if ($entrada->insertar($entrada)) {

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
                                         closeOnConfirm: true 
                                       }, 
                                       function(){ 
                                        
                                       });  
                                 </script>';    
		 ?>
		 <!-- <meta http-equiv="refresh" content="0; url=http://localhost:8080/SIR/listEntry">  -->
<?php 
	}
} ?>
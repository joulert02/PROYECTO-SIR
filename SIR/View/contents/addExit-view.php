<?php
	require_once "Controller/exitController.php";
	require_once 'Controller/productController.php';
    $produtos = new  productoController();
    
	$controool = new exitController();
	$Salida = new  exitModel();
	$categoriaController = new  CategoriaController();
	$tipoSalida = new tipoSalidaModel();
?>
 <style type="text/css">
  .container{  
    width:900px;
    height: 415px;
  }
</style>

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
             <label ><h4><b>Nueva Salida</b></h4></label>
          </div>
      <div class="panel-body"> 

	<form  id="validate_form" method="POST">
		<div class="form-row">
			<div class="col-md-4">
				<label>Fecha Salida</label><br>
				<input type="date" name="fecha_salida" value="<?php echo date("Y-m-d");?>"required class="form-control"><br><br>
			</div>
				<div class="col-md-4">
				<label>Tipo Salida</label>
				<select name="tipo_salida_tipo_salida" class="custom-select form-control" required>
	 				<option value="true" selected disabled>Seleccione tipo Salida</option>
					 <?php
					 foreach ($tipoSalida->consultarTipoSalida() as $dato) {
							echo '<option value="'.$dato->tipo_salida.'">'.$dato->nombre.'</option>;';
					 }
					 ?>
				</select>
			</div>
		<div class="col-md-4">
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
			<?php foreach ($produtos->listar() as $r):?>
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


 <script src="http://localhost/SIR/ajax/Salida.js"></script>




	<?php
	if (isset($_POST["registrar"])) {

		$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta = $conec->prepare("SELECT * FROM tmp_salida");
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
                                         window.location.href="'.SERVERURL.'addExit"; 
                                       });  
                                 </script>';
                                 return false;    
}
//$CantidadPersonas = (count($contarRegistros)==0);
//alert("no hay productos agregados "); 
            $Salida->__SET('fecha_salida',  $_POST['fecha_salida']);
			$Salida->__SET('tipo_salida_tipo_salida', $_POST['tipo_salida_tipo_salida']);

			if (($Salida->fecha_salida == "")) 
		{
			  echo'<script type="text/javascript"> 
                                  swal({title: "ERROR",    
                                         text: "No se púdo actualizar la Entrada Revise los campos.", 
                                         type:"error", 
                                         confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addExit"; 
                                       });  
                                 </script>';
                                 return false;   
				}else if ($controool->insertar($Salida)) {

                 echo'<script type="text/javascript"> 
                           swal({title: "LISTO",    
                                 text: "La Salida ha sido registrada correctamente.", 
                                 type:"success", 
                                 confirmButtonText: "OK", 
                                 closeOnConfirm: false 
                               }, 
                               function(){ 
                                 window.location.href="'.SERVERURL.'listExit"; 
                               });  
                         </script>'; 
									}
												else{ 
                         echo'<script type="text/javascript"> 
                          swal({title: "ERROR",    
                                text: "No se púdo registrar la Salida.", 
                                type:"error", 
                                confirmButtonText: "OK", 
                                closeOnConfirm: true 
                              }, 
                              function(){ 
                                
                              });  
                        </script>';    
		 ?>
		 <!-- <meta http-equiv="refresh" content="0; url=http://localhost/SIR/listEntry">  -->
<?php 
	}
} ?>


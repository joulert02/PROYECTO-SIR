	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<style type="text/css">
  .container{  
   width:900px;
   height: 575px;
 }
</style>
<br><br>
<div class="container-fluid">
    <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="fa fa-cart-plus fa-fax3 fa-lg"></span>
             <label ><h4><b>Nuevo Pedido</b></h4></label>
          </div>
          <div class="panel-body"> 
			<form method="post" class="form-horizontal" role="form" id="datos_pedido" ID="validate_form">
				<div class="form-row">
				  
				  <div class="col-md-4">
				  <label for="proveedor" class="control-label">Selecciona el cliente</label>
					 <select class="proveedor form-control" name="proveedor" id="proveedor" required><br>
					</select>
				  </div>
				  
					<div class="col-md-4">
						<label for="transporte" class="control-label">Transporte</label>
						<input type="text" class="form-control " id="transporte" value="Recogido" required><br>
					</div>
					
					<div class="col-md-4">
						<label for="condiciones" class="control-label">N° Comprobante</label>
						<input type="number" class="form-control " id="condiciones" value="500" required><br>
					</div>

					<div class="col-md-4">
					<label for="condiciones" class="control-label">Estado</label><br>
					<select id="estado" class="form-control" required="">
						<option value="" selected disabled>Seleccione Estado</option>
						<option value="1">Pendiente</option>
						<option value="0">Pago</option>
					</select>
					</div>

					<div class="col-md-4">
						<label for="comentarios" class="control-label">Comentarios</label>
						<input type="text" class="form-control" id="comentarios" placeholder="Comentarios o instruciones especiales"><br>
					</div>
							
						
				<hr>
				<div class="col-md-4"><br>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-plus"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="fa fa-print"></span> Imprimir
						</button>
					<!--	<a href="View/contents/reportPedido-view.php" class="btn btn-primary" target="_blank" style="float: right;" role="button">Reporte &nbsp&nbsp<i class="fa fa-file"></i>
					</a>-->
					</div>	
				</div>
			</form>
			<br><br>
		<div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->
	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"> Productos</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input style="display: none;" type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
						</div>
						
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
			
			</div>	
		 </div>
	</div>
</div>


   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
	<!-- Latest compiled and minified JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="public/js/VentanaCentrada.js"></script>
	<script src="public/js/select2.min.js"></script>

	<script>  
$(document).ready(function(){  
     var instance =$('#datos_pedido').parsley();
	});  
</script>


	<script>
		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			var parametros={"action":"ajax","page":page,"q":q};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_pedido.php',
				data: parametros,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	</script>
	<script type="text/javascript" src="public/lib/alertify.js"></script>
		<link rel="stylesheet" href="public/themes/alertify.core.css" />
		<link rel="stylesheet" href="public/themes/alertify.default.css" />
	<script>
	function agregar(id)
		{
			var precio_venta=$('#precio_venta_'+id).val();
			var cantidad=$('#cantidad_'+id).val();
			// Inicia validacion
			if (cantidad==1)
			{
			alertify.success("<i class=\"fa fa-check-circle\"></i> <b>Producto</b> Agregado correctamente"); 
			}
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			// Fin validacion
		var parametros={"id":id,"precio_venta":precio_venta,"cantidad":cantidad};	
		$.ajax({
        type: "POST",
        url: "./ajax/agregar_pedido.php",
        data: parametros,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar(id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_pedido.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);

			alertify.error("<i class=\"fa fa-check-circle\"></i> <b>Producto</b> Anulado correctamente"); 
			
		}
			});

		}
		
		$("#datos_pedido").submit(function(){
		  var proveedor = $("#proveedor").val();
		  var transporte = $("#transporte").val();
		  var condiciones = $("#condiciones").val();
		  var comentarios = $("#comentarios").val();
		  var estado = $("#estado").val();
			
		  if (proveedor>0)
		 {
			VentanaCentrada('View/contents/reportPedido-view.php?proveedor='+proveedor+'&estado='+estado+'&transporte='+transporte+'&condiciones='+condiciones+'&comentarios='+comentarios,'Pedido','','1024','768','true');	
		 } else {
			 //alert("Selecciona el Cliente");
			 return false;
		 }
		 
	 	});
	</script>
	
	
<script type="text/javascript">
$(document).ready(function() {
    $( ".proveedor" ).select2({        
    ajax: {
        url: "ajax/load_proveedores.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
});
});
</script>
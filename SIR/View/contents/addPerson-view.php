<?php
	require_once "Controller/personController.php";
	$control = new personController();
	$usuario = new  personModel();
	$tipoDocumentoPersona = new tipoDocumentoPersonModel();
?>
<br>
	<div class="container-fluid">

		<div class="col-md-10 col-md-offset-1 ">
      <div class="panel panel-default">
           <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="fa fa-user-plus fa-fax3 fa-lg"></span>
             <label ><h4><b>Nueva Persona</b></h4></label>
          </div>
      <div class="panel-body"> 
		<form  method="POST" id="validate_form" autocomplete="off" enctype="multipart/form-data">	
		<div class="form-row">
				<div class="col-md-4 mb-3">
					<label>Nombres</label>
					<input type="text" name="nombres" class="form-control" required data-parsley-length="[3,20]">
				</div>
				<div class="col-md-4 mb-3">
					<label>Apellidos</label>
					<input type="text" name="apellidos" class="form-control" required data-parsley-length="[3,20]">
				</div>
				<div class="col-md-4 mb-3 ">
					<label>Tipo Documento</label>
					<select name="tipo_documento_tipo_documento" class="custom-select form-control" required="">
					<option value="true" selected disabled>Seleccione un documento</option>
					<?php
						foreach ($tipoDocumentoPersona->consultarTipoDocumento() as $dato) {
							echo '<option value="'.$dato->tipo_documento.'">'.$dato->nombre_documento	.'</option>';
						}
					?>
					</select><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Documento</label><br>
					<input type="number" name="documento" class="form-control" required data-parsley-length="[10,14]" data-parsley-type="number">
				</div>
				<div class="col-md-4 mb-3">
					<label>Teléfono</label><br>
					<input type="number" name="telefono" class="form-control" data-parsley-length="[7,10]" data-parsley-type="number">
				</div>
				<div class="col-md-4 mb-3">
					<label>Celular</label><br>
					<input type="number" name="nro_Celular" class="form-control" required data-parsley-length="[10,12]" data-parsley-type="number"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Dirección</label><br>
					<input type="text" name="direccion" class="form-control" data-parsley-length="[4,25]">
				</div>
				<div class="col-md-4 mb-3">
					<label>Ciudad</label><br>
					<input type="text" name="ciudad" class="form-control" required data-parsley-length="[3,20]">
				</div>
				<div class="col-md-4 mb-3">
					<label>Departamento</label><br>
					<input type="text" name="departamento" class="form-control" required data-parsley-length="[3,20]"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select form-control" required="">
					<option value="true" selected disabled>Seleccione tipo Persona</option>
					<?php
						foreach ($tipoDocumentoPersona->consultarTipoPersona() as $dato) {
							echo '<option value="'.$dato->tipo_persona.'">'.$dato->nombre_tipo	.'</option>';
						}
					?>
					</select><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select form-control" required="">
						<option value="true" selected disabled>Seleccione estado</option>
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select><br>
				</div>
			</div>
			<div class="col-md-12 mb-3">
			<input type="submit" id="registrar" name="registrar" class="btn btn-primary" value="Registrar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
    	<a href="<?php echo SERVERURL; ?>listPerson"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
			</div>
		</form>
	</div>
</div>
</div>
</div>
			<script>  
$(document).ready(function(){  
     var instance =$('#validate_form').parsley();
	});  
</script>

		<?php
			 if (isset($_POST["registrar"])) {
			 	$usuario->__SET('nombres', $_POST["nombres"]);
			 	$usuario->__SET('apellidos', $_POST["apellidos"]);
			 	$usuario->__SET('tipo_documento_tipo_documento', $_POST["tipo_documento_tipo_documento"]);
			 	$usuario->__SET('documento', $_POST["documento"]);
			 	$usuario->__SET('telefono', $_POST["telefono"]);
			 	$usuario->__SET('nro_Celular', $_POST["nro_Celular"]);
			 	$usuario->__SET('direccion', $_POST["direccion"]);
			 	$usuario->__SET('ciudad', $_POST["ciudad"]);
			 	$usuario->__SET('departamento', $_POST["departamento"]);
			 	$usuario->__SET('tipo_persona_tipo_persona', $_POST["tipo_persona_tipo_persona"]);
			 	$usuario->__SET('estado', $_POST["estado"]);

			 
$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
 $consulta1 = $conec->prepare("SELECT `documento` FROM `tbl_persona` WHERE documento=$usuario->documento");
 $consulta1 ->  execute();
		if ($consulta1->rowCount() >= 1) {
			echo '<div class="alert alert-danger" role="alert">
			Esté documento ya se encuentra registrado
		</div>';
		
 		/*	 echo'<script type="text/javascript"> 
                                   swal({title: "ERROR",    
                                         text: "No se púdo registrar el cliente Revise los campos.", 
                                         type:"error", 
                                         confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addPerson"; 
                                       });  
                                 </script>';
                                 return false;  */  
 		}
 	else if ($control->insertar($usuario)) {

                   echo'<script type="text/javascript"> 
                             swal({title: "LISTO",    
                                   text: "El cliente ha sido registrado correcto.", 
                                   type:"success", 
                                   confirmButtonText: "OK", 
                                   closeOnConfirm: false 
                                 }, 
                                 function(){ 
                                   window.location.href="'.SERVERURL.'listPerson"; 
                                 });  
                           </script>'; 
                           }else{ 

                           echo'<script type="text/javascript"> 
                                   swal({title: "ERROR",    
                                         text: "No se púdo registrar el cliente. Intenta más tarde.", 
                                         type:"error", 
                                         confirmButtonText: "OK", 
                                         closeOnConfirm: false 
                                       }, 
                                       function(){ 
                                         window.location.href="'.SERVERURL.'addPerson"; 
                                       });  
                                 </script>';    
 		?>
 		<meta http-equiv="refresh" content="0; url=http:localhost:8080/SIR/listPerson"> 
 <?php 
 	}
 } ?>
</div>
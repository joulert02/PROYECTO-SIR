<?php
	require_once "Controller/personController.php";
	$tipoDocumentoPersona = new tipoDocumentoPersonModel();
?>

<div class="container-fluid" style="margin-top: 7%">
	<div class="col-md-8 col-xs-12 col-md-offset-2 mt-1">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4><strong><span class="fa fa-user-plus fa-lg" style="padding-right: 5px;"></span>Nueva Persona</strong></h4>
        </div>
      	<div class="panel-body"> 
			<form data-form="save" action="<?php echo SERVERURL; ?>ajax/personAjax.php" method="POST" class="FormularioAjax" id="validate_form" autocomplete="off" enctype="multipart/form-data">	
				<div class="RespuestaAjax row col-md-12"></div>
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
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
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

<script>  
$(document).ready(function(){  
		 var instance =$('#validate_form').parsley();
});  
</script>